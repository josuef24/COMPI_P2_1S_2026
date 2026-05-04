<?php

namespace Golampi\compiler;

use Golampi\GolampiBaseVisitor;

class GolampiSemanticVisitor extends GolampiBaseVisitor {
    private $errorReport;
    private $symbolReport;
    private $generator;
    private $env;
    private $loopStack = [];
    private $funcTable = [];
    private $currentFunc = '';
    
    public function __construct($errorReport, $symbolReport, $generator) {
        $this->errorReport = $errorReport;
        $this->symbolReport = $symbolReport;
        $this->generator = $generator;
        $this->env = new Environment(null, 'global');
    }
    
    public function visitProgram($context) {
        // Pre-visit: declare all functions
        if ($context->declarations()) {
            foreach ($context->declarations()->declaration() as $decl) {
                if ($decl->funcDecl()) {
                    $funcCtx = $decl->funcDecl();
                    $funcName = $funcCtx->ID()->getText();
                    $returnTypes = [];
                    if ($funcCtx->returnType()) {
                        $rt = $funcCtx->returnType();
                        $types = $rt->type();
                        if (is_array($types)) {
                            foreach ($types as $tCtx) {
                                $returnTypes[] = $tCtx->getText();
                            }
                        } else if ($types !== null) {
                            $returnTypes[] = $types->getText();
                        }
                    }
                    $this->env->declare($funcName, 'func', true, 8, $funcCtx->start->getLine(), $funcCtx->start->getCharPositionInLine(), $funcName);
                    $sym = $this->env->get($funcName);
                    $sym['returnTypes'] = $returnTypes;
                    $this->env->update($funcName, $sym);
                    
                    $this->symbolReport->addSymbol([
                        'name' => $funcName,
                        'type' => 'func',
                        'scope' => 'global',
                        'value' => 'Function',
                        'line' => $funcCtx->start->getLine(),
                        'col' => $funcCtx->start->getCharPositionInLine()
                    ]);
                    
                    // Keep funcTable for compatibility
                    $this->funcTable[$funcName] = count($returnTypes) > 0 ? $returnTypes[0] : 'void';
                }
            }
        }

        $this->generator->addText("_start:");
        $this->generator->addText("    bl main");
        $this->generator->addText("    mov x0, 0");
        $this->generator->addText("    mov x8, 93");
        $this->generator->addText("    svc 0");
        
        return $this->visitChildren($context);
    }
    
    private function calcArraySize($type) {
        if (strpos($type, '[') === false || $type[0] === '*') return 8;
        $size = 1;
        $p = 0;
        while (($p = strpos($type, '[', $p)) !== false) {
            $p2 = strpos($type, ']', $p);
            if ($p2 === false) break;
            $dimStr = substr($type, $p + 1, $p2 - $p - 1);
            $dim = intval($dimStr);
            if ($dim > 0) $size *= $dim;
            $p = $p2 + 1;
        }
        return $size * 8;
    }
    
    public function visitFuncDecl($context) {
        $funcName = $context->ID()->getText();
        $this->currentFunc = $funcName;
        
        $retType = isset($this->funcTable[$funcName]) ? $this->funcTable[$funcName] : 'void';
        $returnsArray = strpos($retType, '[') !== false && $retType[0] !== '*';
        
        $prevEnv = $this->env;
        $this->env = new Environment($prevEnv, 'func', new \stdClass());
        $this->env->getOffsetTracker()->offset = $returnsArray ? 48 : 40;
        
        $params = [];
        if ($context->paramList()) {
            foreach ($context->paramList()->param() as $paramCtx) {
                $params[] = ['id' => $paramCtx->ID()->getText(), 'type' => $paramCtx->type()->getText()];
            }
            
            $paramContexts = $context->paramList()->param();
            $currentOffset = 16;
            for ($i = count($params) - 1; $i >= 0; $i--) {
                $pCtx = $paramContexts[$i];
                $paramSize = $this->calcArraySize($params[$i]['type']);
                $this->env->declareParam($params[$i]['id'], $params[$i]['type'], $currentOffset, $pCtx->start->getLine(), $pCtx->start->getCharPositionInLine());
                $this->symbolReport->addSymbol([
                    'name' => $params[$i]['id'],
                    'type' => $params[$i]['type'],
                    'scope' => $funcName,
                    'value' => 'Param (offset ' . $currentOffset . ')',
                    'line' => $pCtx->start->getLine(),
                    'col' => $pCtx->start->getCharPositionInLine()
                ]);
                $currentOffset += $paramSize;
            }
        }
        
        $this->generator->addText("\n" . $funcName . ":");
        $this->generator->addText("    stp x29, x30, [sp, -16]!");
        $this->generator->addText("    mov x29, sp");
        $this->generator->addText("    stp x19, x20, [sp, -16]!");
        $this->generator->addText("    stp x21, x22, [sp, -16]!");
        $this->generator->addText("    str d8, [sp, -8]!");
        if ($returnsArray) {
            $this->generator->addText("    str x8, [sp, -8]!");
        }
        
        $this->visit($context->block());
        
        $this->generator->addText(".L_end_func_$funcName:");
        if ($returnsArray) {
            $this->generator->addText("    add sp, sp, 8");
        }
        $this->generator->addText("    ldr d8, [x29, -40]");
        $this->generator->addText("    ldp x21, x22, [x29, -32]");
        $this->generator->addText("    ldp x19, x20, [x29, -16]");
        $this->generator->addText("    mov sp, x29");
        $this->generator->addText("    ldp x29, x30, [sp], 16");
        $this->generator->addText("    ret");
        
        $this->env = $prevEnv;
        return null;
    }
    
    public function visitReturnStmt($context) {
        if ($context->expList()) {
            $exprs = $context->expList()->expression();
            $N = count($exprs);
            $types = [];
            for ($i = 0; $i < $N; $i++) {
                $types[] = $this->visit($exprs[$i]);
            }
            
            if ($N == 1 && strpos($types[0], '[') !== false && $types[0][0] !== '*') {
                // Array return
                $this->generator->addText("    ldr x1, [sp], 8"); // address of the array to return
                $this->generator->addText("    ldr x0, [x29, -48]"); // Load saved x8 from stack
                $sizeBytes = $this->calcArraySize($types[0]);
                for ($i = 0; $i < ($sizeBytes / 8); $i++) {
                    $this->generator->addText("    ldr x2, [x1, " . ($i * 8) . "]");
                    $this->generator->addText("    str x2, [x0, " . ($i * 8) . "]");
                }
            } else {
                for ($i = $N - 1; $i >= 0; $i--) {
                    if ($i < 8) {
                        if (strpos($types[$i], 'float') !== false) {
                            $this->generator->addText("    ldr s$i, [sp], 8");
                        } else {
                            $this->generator->addText("    ldr x$i, [sp], 8");
                        }
                    }
                }
            }
        }
        $this->generator->addText("    b .L_end_func_" . $this->currentFunc);
        return null;
    }
    
    public function visitFuncCallStmt($context) {
        if ($context->builtinCall()) {
            return $this->visitBuiltinCall($context->builtinCall());
        }
        return $this->visitCallExpr($context);
    }
    
    public function visitCallExpr($context) {
        $funcName = $context->expression() ? $context->expression()->getText() : $context->getChild(0)->getText();
        
        // Handle type casts
        if ($funcName === 'float32' || $funcName === 'int32') {
            $exprs = $context->expList() ? $context->expList()->expression() : [];
            if (count($exprs) > 0) {
                $t = $this->visit($exprs[0]);
                $this->generator->addText("    ldr x0, [sp], 8");
                if ($funcName === 'float32' && $t === 'int32') {
                    $this->generator->addText("    scvtf s0, w0");
                    $this->generator->addText("    fmov w0, s0");
                } else if ($funcName === 'int32' && $t === 'float32') {
                    $this->generator->addText("    fmov s0, w0");
                    $this->generator->addText("    fcvtzs x0, s0");
                }
                $this->generator->addText("    str x0, [sp, -8]!");
                return $funcName;
            }
        }
        
        $exprs = $context->expList() ? $context->expList()->expression() : [];
        
        $retType = isset($this->funcTable[$funcName]) ? $this->funcTable[$funcName] : 'void';
        $returnsArray = strpos($retType, '[') !== false && $retType[0] !== '*';
        $arrayBytes = 0;
        if ($returnsArray) {
            $arrayBytes = $this->calcArraySize($retType);
            $this->generator->addText("    sub sp, sp, $arrayBytes");
            $this->generator->addText("    str x8, [sp, -8]!");
            $this->generator->addText("    add x8, sp, 8");
        }
        
        $this->generator->addText("    str x19, [sp, -8]!");
        $this->generator->addText("    mov x19, sp");
        
        for ($i = 0; $i < count($exprs); $i++) {
            $argExpr = $exprs[$i];
            $argType = $this->visit($argExpr);
            if (strpos($argType, '[') !== false && $argType[0] !== '*') {
                $this->generator->addText("    ldr x1, [sp], 8");
                $asizeBytes = $this->calcArraySize($argType);
                $asize = $asizeBytes / 8;
                for ($k = $asize - 1; $k >= 0; $k--) {
                    $this->generator->addText("    ldr x0, [x1, " . ($k * 8) . "]");
                    $this->generator->addText("    str x0, [sp, -8]!");
                }
            }
        }
        
        $this->generator->addText("    mov x10, sp");
        $this->generator->addText("    sub x9, x19, x10");
        $this->generator->addText("    bl $funcName");
        $this->generator->addText("    add sp, sp, x9");
        $this->generator->addText("    ldr x19, [sp], 8");
        
        $sym = $this->env->get($funcName);
        $returnTypes = ($sym && isset($sym['returnTypes'])) ? $sym['returnTypes'] : [];
        
        if ($returnsArray) {
            $this->generator->addText("    ldr x8, [sp], 8");
            $this->generator->addText("    mov x0, sp");
            $this->generator->addText("    str x0, [sp, -8]!");
            return $retType;
        } else {
            for ($i = count($returnTypes) - 1; $i >= 0; $i--) {
                if ($i < 8) {
                    if (strpos($returnTypes[$i], 'float') !== false) {
                        $this->generator->addText("    str s$i, [sp, -8]!");
                    } else {
                        $this->generator->addText("    str x$i, [sp, -8]!");
                    }
                }
            }
            return count($returnTypes) > 0 ? $returnTypes[0] : 'void';
        }
    }
    
    public function visitBlock($context) {
        $prevEnv = $this->env;
        $this->env = new Environment($prevEnv, 'local', $prevEnv->getOffsetTracker());
        $startOffset = $this->env->getOffsetTracker() ? $this->env->getOffsetTracker()->offset : 0;
        
        foreach ($context->statement() as $stmt) {
            $this->visit($stmt);
        }
        
        if ($this->env->getOffsetTracker()) {
            $endOffset = $this->env->getOffsetTracker()->offset;
            $diff = $endOffset - $startOffset;
            if ($diff > 0) {
                $this->generator->addText("    add sp, sp, $diff");
                $this->env->getOffsetTracker()->offset = $startOffset;
            }
        }
        
        $this->env = $prevEnv;
        return null;
    }
    
    // Copy if, switch, for logic from before
    public function visitIfStmt($context) {
        $falseLabel = $this->generator->newLabel(".L_if_false_");
        $endLabel = $this->generator->newLabel(".L_if_end_");
        $this->visit($context->expression());
        $this->generator->addText("    ldr x0, [sp], 8");
        $this->generator->addText("    cbz x0, $falseLabel");
        $this->visit($context->block(0));
        if ($context->ELSE() !== null) {
            $this->generator->addText("    b $endLabel");
            $this->generator->addText("$falseLabel:");
            if ($context->ifStmt() !== null) $this->visit($context->ifStmt());
            else if ($context->block(1) !== null) $this->visit($context->block(1));
            $this->generator->addText("$endLabel:");
        } else {
            $this->generator->addText("$falseLabel:");
        }
        return null;
    }
    
    public function visitSwitchStmt($context) {
        $endLabel = $this->generator->newLabel(".L_switch_end_");
        $this->visit($context->expression());
        
        $this->loopStack[] = ['start' => null, 'end' => $endLabel];
        
        foreach ($context->switchCase() as $caseCtx) {
            $nextCaseLabel = $this->generator->newLabel(".L_case_next_");
            $exprs = $caseCtx->expList()->expression();
            $matchLabel = $this->generator->newLabel(".L_case_match_");
            
            foreach ($exprs as $expr) {
                $this->visit($expr);
                $this->generator->addText("    ldr x0, [sp], 8");
                $this->generator->addText("    ldr x1, [sp]"); // Peek switch value
                $this->generator->addText("    cmp x0, x1");
                $this->generator->addText("    b.eq $matchLabel");
            }
            $this->generator->addText("    b $nextCaseLabel");
            
            $this->generator->addText("$matchLabel:");
            foreach ($caseCtx->statement() as $stmt) {
                $this->visit($stmt);
            }
            $this->generator->addText("    b $endLabel");
            $this->generator->addText("$nextCaseLabel:");
        }
        
        if ($context->switchDefault()) {
            foreach ($context->switchDefault()->statement() as $stmt) {
                $this->visit($stmt);
            }
        }
        
        $this->generator->addText("$endLabel:");
        $this->generator->addText("    add sp, sp, 8"); // Pop switch value
        array_pop($this->loopStack);
        return null;
    }

    public function visitBreakStmt($context) {
        $loop = end($this->loopStack);
        if ($loop && $loop['end']) {
            $this->generator->addText("    b " . $loop['end']);
        }
        return null;
    }

    public function visitContinueStmt($context) {
        $loop = end($this->loopStack);
        if ($loop && $loop['start']) {
            $this->generator->addText("    b " . $loop['start']);
        }
        return null;
    }
    
    public function visitForStmt($context) {
        $startLabel = $this->generator->newLabel(".L_for_start_");
        $updateLabel = $this->generator->newLabel(".L_for_update_");
        $endLabel = $this->generator->newLabel(".L_for_end_");
        $this->loopStack[] = ['start' => $updateLabel, 'end' => $endLabel];
        $prevEnv = $this->env;
        $this->env = new Environment($prevEnv, 'local', $prevEnv->getOffsetTracker());
        
        if ($context->SEMI() !== null && count($context->SEMI()) > 0) {
            if ($context->varDecl() !== null) $this->visit($context->varDecl());
            $this->generator->addText("$startLabel:");
            if ($context->expression() !== null) {
                $this->visit($context->expression());
                $this->generator->addText("    ldr x0, [sp], 8");
                $this->generator->addText("    cbz x0, $endLabel");
            }
            $this->visit($context->block());
            $this->generator->addText("$updateLabel:");
            if ($context->incDecStmt() !== null) $this->visit($context->incDecStmt());
            $this->generator->addText("    b $startLabel");
            $this->generator->addText("$endLabel:");
        } else if ($context->expression() !== null) {
            $this->generator->addText("$startLabel:");
            $this->generator->addText("$updateLabel:");
            $this->visit($context->expression());
            $this->generator->addText("    ldr x0, [sp], 8");
            $this->generator->addText("    cbz x0, $endLabel");
            $this->visit($context->block());
            $this->generator->addText("    b $startLabel");
            $this->generator->addText("$endLabel:");
        } else {
            $this->generator->addText("$startLabel:");
            $this->generator->addText("$updateLabel:");
            $this->visit($context->block());
            $this->generator->addText("    b $startLabel");
            $this->generator->addText("$endLabel:");
        }
        $this->env = $prevEnv;
        array_pop($this->loopStack);
        return null;
    }
    
    public function visitIncDecStmt($context) {
        $this->visitLValueAddress($context->expression());
        $op = $context->getChild(1)->getText();
        $this->generator->addText("    ldr x1, [sp], 8"); 
        $this->generator->addText("    ldr x0, [x1]");
        if ($op === '++') $this->generator->addText("    add x0, x0, 1");
        else $this->generator->addText("    sub x0, x0, 1");
        $this->generator->addText("    str x0, [x1]");
        return null;
    }
    
    private function visitLValueAddress($expr) {
        if ($expr instanceof \Golampi\DerefExprContext || method_exists($expr, 'MULT')) {
            $innerExpr = $expr->expression();
            if (is_array($innerExpr)) $innerExpr = $innerExpr[0];
            $ptrType = $this->visit($innerExpr);
            return str_replace('*', '', $ptrType);
        }
        if ($expr instanceof \Golampi\IndexExprContext || (method_exists($expr, 'getChildCount') && $expr->getChildCount() >= 4 && $expr->getChild(1)->getText() === '[')) {
            $baseType = $this->visit($expr->expression(0));
            
            preg_match_all('/\[(\d+)\]/', $baseType, $matches);
            $dims = $matches[1];
            $numDims = count($dims);
            
            $numIndices = 0;
            $indexExprs = [];
            for ($i = 1; $i < count($expr->expression()); $i++) {
                $indexExprs[] = $expr->expression($i);
                $numIndices++;
            }
            
            $weights = [];
            for ($i = 0; $i < $numDims; $i++) {
                $weight = 1;
                for ($j = $i + 1; $j < $numDims; $j++) {
                    $weight *= intval($dims[$j]);
                }
                $weights[] = $weight;
            }
            
            $this->generator->addText("    mov x0, 0");
            $this->generator->addText("    str x0, [sp, -8]!"); // accumulator
            
            for ($i = 0; $i < count($indexExprs); $i++) {
                $this->visit($indexExprs[$i]);
                $this->generator->addText("    ldr x0, [sp], 8");
                $w = $weights[$i];
                $this->generator->addText("    mov x1, $w");
                $this->generator->addText("    mul x0, x0, x1");
                $this->generator->addText("    ldr x1, [sp]"); // PEEK accumulator
                $this->generator->addText("    add x1, x1, x0");
                $this->generator->addText("    str x1, [sp]"); // UPDATE accumulator
            }
            
            $this->generator->addText("    ldr x0, [sp], 8"); // offset in elements
            $this->generator->addText("    lsl x0, x0, 3"); // * 8 bytes
            $this->generator->addText("    ldr x1, [sp], 8"); // base address
            $this->generator->addText("    add x0, x1, x0");
            $this->generator->addText("    str x0, [sp, -8]!");
            
            $innerType = $baseType;
            for ($i = 0; $i < $numIndices; $i++) {
                $innerType = preg_replace('/\[\d+\]/', '', $innerType, 1);
            }
            return $innerType;
        }
        
        $id = $expr->getText();
        $sym = $this->env->get($id);
        if ($sym) {
            if ($sym['isGlobal']) {
                $this->generator->addText("    adrp x0, " . $sym['label']);
                $this->generator->addText("    add x0, x0, :lo12:" . $sym['label']);
            } else {
                if ($sym['offset'] >= 0) {
                    $this->generator->addText("    add x0, x29, " . $sym['offset']);
                } else {
                    $this->generator->addText("    sub x0, x29, " . abs($sym['offset']));
                }
            }
            $this->generator->addText("    str x0, [sp, -8]!");
            return $sym['type'];
        }
        return 'int32';
    }

    public function visitVarDecl($context) {
        $isShortDecl = $context->DECL_ASSIGN() !== null;
        $ids = $this->getIds($context->idList());
        $exprsRight = $context->expList() ? $context->expList()->expression() : [];
        $type = 'int32';
        if (!$isShortDecl) {
            $type = $context->type()->getText();
        }
        
        $sizeBytes = $this->calcArraySize($type);
        
        
        if (count($ids) > 1 && count($exprsRight) == 1) {
            $rhsType = $this->visit($exprsRight[0]);
            $funcName = $exprsRight[0] instanceof \Golampi\grammar\GolampiParser\CallExprContext ? ($exprsRight[0]->expression() ? $exprsRight[0]->expression()->getText() : $exprsRight[0]->getChild(0)->getText()) : "";
            $symFunc = $this->env->get($funcName);
            $retTypes = ($symFunc && isset($symFunc['returnTypes'])) ? $symFunc['returnTypes'] : [$rhsType];
            
            // Pop return values into temporary registers x10, x11, ...
            for ($i = 0; $i < count($ids); $i++) {
                if ($i < 8) $this->generator->addText("    ldr x" . ($i + 10) . ", [sp], 8");
            }

            for ($i = 0; $i < count($ids); $i++) {
                $id = $ids[$i];
                $thisType = isset($retTypes[$i]) ? $retTypes[$i] : $rhsType;
                $thisSize = $this->calcArraySize($thisType);
                
                if ($this->env->declare($id, $thisType, false, $thisSize, $context->start->getLine(), $context->start->getCharPositionInLine())) {
                    $sym = $this->env->get($id);
                    if ($sym['isGlobal']) {
                        $this->generator->addData($sym['label'], ".skip", $thisSize);
                        $this->generator->addText("    adrp x1, " . $sym['label']);
                        $this->generator->addText("    add x1, x1, :lo12:" . $sym['label']);
                    } else {
                        $this->generator->addText("    sub sp, sp, $thisSize");
                        $this->generator->addText("    sub x1, x29, " . abs($sym['offset']));
                    }
                    if (strpos($thisType, '[') === false || $thisType[0] === '*') {
                        $this->generator->addText("    str x" . ($i + 10) . ", [x1]");
                    } else {
                        // Array copy
                        $sizeArr = $this->calcArraySize($thisType);
                        for ($j = 0; $j < ($sizeArr / 8); $j++) {
                            $this->generator->addText("    ldr x2, [x" . ($i + 10) . ", " . ($j * 8) . "]");
                            $this->generator->addText("    str x2, [x1, " . ($j * 8) . "]");
                        }
                    }
                }
            }
            return null;
        }

        for ($i = 0; $i < count($ids); $i++) {
            $id = $ids[$i];
            
            if (count($ids) == 2 && count($exprsRight) == 2 && !isset($exprsRight[0]->start)) {
                $this->generator->addText("    ldr x0, [sp], 8");
            } else if (isset($exprsRight[$i])) {
                $t = $this->visit($exprsRight[$i]);
                if ($isShortDecl) {
                    $type = $t;
                    $sizeBytes = $this->calcArraySize($type);
                }
                $this->generator->addText("    ldr x0, [sp], 8"); // val or address
            } else {
                $this->generator->addText("    mov x0, 0");
                $t = 'int32';
            }
            
            $line = $context->start->getLine();
            $col = $context->start->getCharPositionInLine();
            
            if ($this->env->declare($id, $type, false, $sizeBytes, $line, $col)) {
                $sym = $this->env->get($id);
                $this->symbolReport->addSymbol([
                    'name' => $id,
                    'type' => $type,
                    'scope' => $this->env->getScopeName(),
                    'value' => $sym['isGlobal'] ? 'Global (' . $sym['label'] . ')' : 'Local (offset ' . $sym['offset'] . ')',
                    'line' => $line,
                    'col' => $col
                ]);
                $sym = $this->env->get($id);
                if ($sym['isGlobal']) {
                    $this->generator->addData($sym['label'], ".skip", $sizeBytes);
                    $this->generator->addText("    adrp x1, " . $sym['label']);
                    $this->generator->addText("    add x1, x1, :lo12:" . $sym['label']);
                } else {
                    $this->generator->addText("    sub sp, sp, $sizeBytes");
                    // Zero-initialize
                    $this->generator->addText("    mov x2, 0");
                    for ($j = 0; $j < ($sizeBytes / 8); $j++) {
                        $this->generator->addText("    str x2, [sp, " . ($j * 8) . "]");
                    }
                    $this->generator->addText("    sub x1, x29, " . abs($sym['offset']));
                }
                
                if (strpos($type, '[') === false || $type[0] === '*') {
                    $this->generator->addText("    str x0, [x1]");
                } else {
                    if (isset($exprsRight[$i])) {
                        for ($j = 0; $j < ($sizeBytes / 8); $j++) {
                            $this->generator->addText("    ldr x2, [x0, " . ($j * 8) . "]");
                            $this->generator->addText("    str x2, [x1, " . ($j * 8) . "]");
                        }
                    }
                }
                
                // Cleanup stack if RHS was an array-returning call
                $rhsExpr = isset($exprsRight[$i]) ? $exprsRight[$i] : null;
                $isCall = ($rhsExpr !== null) && is_object($rhsExpr) && 
                          ((method_exists($rhsExpr, 'builtinCall') && $rhsExpr->builtinCall() !== null) || 
                           ($rhsExpr instanceof \Golampi\grammar\GolampiParser\CallExprContext));
                if ($isCall && isset($t) && strpos($t, '[') !== false && $t[0] !== '*') {
                    $rhsSize = $this->calcArraySize($t);
                    $this->generator->addText("    add sp, sp, $rhsSize");
                }
            }
        }
        return null;
    }
    
    public function visitAssignment($context) {
        $exprsRight = $context->expList()->expression();
        $exprsLeft = $context->exprList()->expression();
        $op = $context->assignOp()->getText();
        
        if (count($exprsLeft) > 1 && count($exprsRight) == 1) {
            $rhsType = $this->visit($exprsRight[0]);
            for ($i = 0; $i < count($exprsLeft); $i++) {
                $type = $this->visitLValueAddress($exprsLeft[$i]);
                // Stack: [addr, ret0, ret1, ...]
                // After visitLValueAddress, sp points to addr.
                $this->generator->addText("    ldr x1, [sp], 8"); // Pop addr
                $this->generator->addText("    ldr x0, [sp], 8"); // Pop value
                $this->generator->addText("    str x0, [x1]");
            }
            return null;
        }

        for ($i = 0; $i < count($exprsLeft); $i++) {
            $type = $this->visitLValueAddress($exprsLeft[$i]);
            
            if ($op !== '=') {
                $this->generator->addText("    ldr x1, [sp], 8");
                $this->generator->addText("    ldr x0, [x1]");
                $this->generator->addText("    str x1, [sp, -8]!");
                $this->generator->addText("    str x0, [sp, -8]!");
            }
            
            $rhsType = $this->visit($exprsRight[$i]);
            
            if ($op !== '=') {
                $this->generator->addText("    ldr x1, [sp], 8"); // RHS
                $this->generator->addText("    ldr x0, [sp], 8"); // LHS val
                if ($type === 'float32') {
                    $this->generator->addText("    fmov s0, w0");
                    $this->generator->addText("    fmov s1, w1");
                    if ($op === '+=') $this->generator->addText("    fadd s0, s0, s1");
                    else if ($op === '-=') $this->generator->addText("    fsub s0, s0, s1");
                    else if ($op === '*=') $this->generator->addText("    fmul s0, s0, s1");
                    else if ($op === '/=') $this->generator->addText("    fdiv s0, s0, s1");
                    $this->generator->addText("    fmov w0, s0");
                } else {
                    if ($op === '+=') $this->generator->addText("    add x0, x0, x1");
                    else if ($op === '-=') $this->generator->addText("    sub x0, x0, x1");
                    else if ($op === '*=') $this->generator->addText("    mul x0, x0, x1");
                    else if ($op === '/=') $this->generator->addText("    sdiv x0, x0, x1");
                }
                $this->generator->addText("    ldr x1, [sp], 8"); // addr
                $this->generator->addText("    str x0, [x1]");
            } else {
                $this->generator->addText("    ldr x0, [sp], 8"); // right (val or addr)
                $this->generator->addText("    ldr x1, [sp], 8"); // left (addr)
                
                if (strpos($type, '[') === false || $type[0] === '*') {
                    $this->generator->addText("    str x0, [x1]");
                } else {
                    $sizeBytes = $this->calcArraySize($type);
                    for ($j = 0; $j < ($sizeBytes / 8); $j++) {
                        $this->generator->addText("    ldr x2, [x0, " . ($j * 8) . "]");
                        $this->generator->addText("    str x2, [x1, " . ($j * 8) . "]");
                    }
                }
                
                // Cleanup stack if RHS was an array-returning call
                $rhsExpr = isset($exprsRight[$i]) ? $exprsRight[$i] : null;
                $isCall = ($rhsExpr !== null) && is_object($rhsExpr) && 
                          ((method_exists($rhsExpr, 'builtinCall') && $rhsExpr->builtinCall() !== null) || 
                           ($rhsExpr instanceof \Golampi\grammar\GolampiParser\CallExprContext));
                if ($isCall && isset($rhsType) && strpos($rhsType, '[') !== false && $rhsType[0] !== '*') {
                    $rhsSize = $this->calcArraySize($rhsType);
                    $this->generator->addText("    add sp, sp, $rhsSize");
                }
            }
        }
        return null;
    }
    
    public function visitBuiltinExpr($context) {
        return $this->visitBuiltinCall($context->builtinCall());
    }

    public function visitBuiltinCall($context) {
        if ($context->FMT_PRINTLN() !== null) {
            $exprs = $context->expList() ? $context->expList()->expression() : [];
            $count = count($exprs);
            for ($i = 0; $i < $count; $i++) {
                $type = $this->visit($exprs[$i]);
                $this->generator->addText("    ldr x0, [sp], 8");
                if (strpos($type, 'string') !== false) $this->generator->addText("    bl print_string");
                else if (strpos($type, 'bool') !== false) $this->generator->addText("    bl print_bool");
                else if (strpos($type, 'float') !== false) {
                    $this->generator->addText("    fmov s0, w0");
                    $this->generator->addText("    bl print_float");
                }
                else if (strpos($type, 'rune') !== false) $this->generator->addText("    bl print_int");
                else if (strpos($type, 'nil') !== false) $this->generator->addText("    bl print_nil");
                else $this->generator->addText("    bl print_int");
                if ($i < $count - 1) $this->generator->addText("    bl print_space");
            }
            $this->generator->addText("    bl print_newline");
        } else if ($context->LEN() !== null) {
            $exprs = is_array($context->expression()) ? $context->expression() : [$context->expression()];
            $type = $this->visit($exprs[0]);
            if (strpos($type, '[') !== false) {
                preg_match('/\[(\d+)\]/', $type, $matches);
                $len = $matches ? (int)$matches[1] : 0;
                $this->generator->addText("    ldr x0, [sp], 8"); // Pop array address
                $this->generator->addText("    ldr x0, =$len");
                $this->generator->addText("    str x0, [sp, -8]!");
            } else {
                $this->generator->addText("    ldr x0, [sp], 8");
                $this->generator->addText("    mov x1, 0");
                $loopLabel = $this->generator->newLabel(".L_len_loop_");
                $endLabel = $this->generator->newLabel(".L_len_end_");
                $this->generator->addText("$loopLabel:");
                $this->generator->addText("    ldrb w2, [x0, x1]");
                $this->generator->addText("    cbz w2, $endLabel");
                $this->generator->addText("    add x1, x1, 1");
                $this->generator->addText("    b $loopLabel");
                $this->generator->addText("$endLabel:");
                $this->generator->addText("    str x1, [sp, -8]!");
            }
            return 'int32';
        } else if ($context->NOW() !== null) {
            $label = $this->generator->newLabel("L_now_");
            $timestamp = date("Y-m-d H:i:s");
            $this->generator->addData($label, ".asciz", "\"$timestamp\"");
            $this->generator->addText("    adrp x0, $label");
            $this->generator->addText("    add x0, x0, :lo12:$label");
            $this->generator->addText("    str x0, [sp, -8]!");
            return 'string';
        } else if ($context->TYPEOF() !== null) {
            $exprs = is_array($context->expression()) ? $context->expression() : [$context->expression()];
            $t = $this->visit($exprs[0]);
            $this->generator->addText("    ldr x0, [sp], 8"); // Pop value
            $label = $this->generator->newLabel("L_type_");
            $this->generator->addData($label, ".asciz", "\"$t\"");
            $this->generator->addText("    adrp x0, $label");
            $this->generator->addText("    add x0, x0, :lo12:$label");
            $this->generator->addText("    str x0, [sp, -8]!");
            return 'string';
        } else if ($context->SUBSTR() !== null) {
            $exprs = is_array($context->expression()) ? $context->expression() : [$context->expression()];
            $this->visit($exprs[0]); // str
            $this->visit($exprs[1]); // start
            $this->visit($exprs[2]); // len
            $this->generator->addText("    ldr x2, [sp], 8"); // len
            $this->generator->addText("    ldr x1, [sp], 8"); // start
            $this->generator->addText("    ldr x0, [sp], 8"); // str address
            $this->generator->addText("    bl substr_copy");
            $this->generator->addText("    str x0, [sp, -8]!");
            return 'string';
        }
        return null;
    }
    
    public function visitStringExpr($context) {
        $val = $context->getText();
        // Remove quotes
        $val = substr($val, 1, -1);
        $label = $this->generator->newLabel("L_str_");
        $this->generator->addData($label, ".asciz", "\"$val\"");
        $this->generator->addText("    adrp x0, $label");
        $this->generator->addText("    add x0, x0, :lo12:$label");
        $this->generator->addText("    str x0, [sp, -8]!");
        return 'string';
    }

    public function visitIntExpr($context) {
        $val = $context->INT_LIT()->getText();
        $this->generator->addText("    ldr x0, =$val");
        $this->generator->addText("    str x0, [sp, -8]!");
        return 'int32';
    }
    
    public function visitFloatExpr($context) {
        $val = floatval($context->FLOAT_LIT()->getText());
        $label = $this->generator->newLabel("L_flt_");
        $this->generator->addData($label, ".float", $val);
        $this->generator->addText("    adrp x1, $label");
        $this->generator->addText("    add x1, x1, :lo12:$label");
        $this->generator->addText("    ldr s0, [x1]");
        $this->generator->addText("    fmov w0, s0");
        $this->generator->addText("    str x0, [sp, -8]!");
        return 'float32';
    }
    
    public function visitBoolExpr($context) {
        $val = ($context->getText() === 'true' || $context->TRUE() !== null) ? 1 : 0;
        $this->generator->addText("    mov x0, $val");
        $this->generator->addText("    str x0, [sp, -8]!");
        return 'bool';
    }

    public function visitRuneExpr($context) {
        $val = $context->getText();
        if (strpos($val, "'") === 0) {
            $char = substr($val, 1, -1);
            if ($char === "\\n") $code = ord("\n");
            else if ($char === "\\t") $code = ord("\t");
            else $code = ord($char);
        } else {
            $code = intval($val);
        }
        $this->generator->addText("    mov x0, $code");
        $this->generator->addText("    str x0, [sp, -8]!");
        return 'rune';
    }

    public function visitNilExpr($context) {
        $this->generator->addText("    mov x0, 0");
        $this->generator->addText("    str x0, [sp, -8]!");
        return 'nil';
    }
    
    public function visitUnaryExpr($context) {
        $t = $this->visit($context->expression());
        $this->generator->addText("    ldr x0, [sp], 8");
        $op = $context->getChild(0)->getText();
        if ($op === '-') {
            if ($t === 'float32') {
                $this->generator->addText("    fmov s0, w0");
                $this->generator->addText("    fneg s0, s0");
                $this->generator->addText("    fmov w0, s0");
            } else {
                $this->generator->addText("    neg x0, x0");
            }
        } else if ($op === '!') {
            $this->generator->addText("    cmp x0, 0");
            $this->generator->addText("    cset x0, eq");
        }
        $this->generator->addText("    str x0, [sp, -8]!");
        return $t;
    }
    
    public function visitConstDecl($context) {
        $id = $context->ID()->getText();
        $type = $context->type()->getText();
        $this->visit($context->expression());
        $this->generator->addText("    ldr x0, [sp], 8");
        
        $line = $context->start->getLine();
        $col = $context->start->getCharPositionInLine();
        
        if ($this->env->declare($id, $type, true, 8, $line, $col)) {
            $sym = $this->env->get($id);
            $this->symbolReport->addSymbol([
                'name' => $id,
                'type' => $type,
                'scope' => $this->env->getScopeName(),
                'value' => 'Const: ' . $context->expression()->getText(),
                'line' => $line,
                'col' => $col
            ]);
            $sym = $this->env->get($id);
            if ($sym['isGlobal']) {
                $this->generator->addData($sym['label'], ".quad", 0);
                $this->generator->addText("    adrp x1, " . $sym['label']);
                $this->generator->addText("    add x1, x1, :lo12:" . $sym['label']);
                $this->generator->addText("    str x0, [x1]");
            } else {
                $this->generator->addText("    sub sp, sp, 8");
                $this->generator->addText("    sub x1, x29, " . abs($sym['offset']));
                $this->generator->addText("    str x0, [x1]");
            }
        }
        return null;
    }
    
    public function visitAndExpr($context) {
        $endLabel = $this->generator->newLabel(".L_and_end_");
        $this->visit($context->expression(0));
        $this->generator->addText("    ldr x0, [sp]"); // PEEK result
        $this->generator->addText("    cbz x0, $endLabel");
        $this->generator->addText("    ldr x0, [sp], 8"); // POP LHS
        $this->visit($context->expression(1));
        $this->generator->addText("$endLabel:");
        return 'bool';
    }

    public function visitOrExpr($context) {
        $endLabel = $this->generator->newLabel(".L_or_end_");
        $this->visit($context->expression(0));
        $this->generator->addText("    ldr x0, [sp]"); // PEEK result
        $this->generator->addText("    cbnz x0, $endLabel");
        $this->generator->addText("    ldr x0, [sp], 8"); // POP LHS
        $this->visit($context->expression(1));
        $this->generator->addText("$endLabel:");
        return 'bool';
    }

    public function visitIdExpr($context) {
        $id = $context->ID()->getText();
        $sym = $this->env->get($id);
        if ($sym) {
            if ($sym['isGlobal']) {
                $this->generator->addText("    adrp x1, " . $sym['label']);
                $this->generator->addText("    add x1, x1, :lo12:" . $sym['label']);
            } else {
                if ($sym['offset'] >= 0) $this->generator->addText("    add x1, x29, " . $sym['offset']);
                else $this->generator->addText("    sub x1, x29, " . abs($sym['offset']));
            }
            if (strpos($sym['type'], '[') === false || $sym['type'][0] === '*') {
                $this->generator->addText("    ldr x0, [x1]");
            } else {
                $this->generator->addText("    mov x0, x1");
            }
            $this->generator->addText("    str x0, [sp, -8]!");
            return $sym['type'];
        }
        return 'int32';
    }
    
    public function visitRefExpr($context) {
        $this->visitLValueAddress($context->expression());
        return '*int32';
    }
    
    public function visitDerefExpr($context) {
        $type = $this->visit($context->expression());
        $this->generator->addText("    ldr x1, [sp], 8");
        $this->generator->addText("    ldr x0, [x1]");
        $this->generator->addText("    str x0, [sp, -8]!");
        return str_replace('*', '', $type);
    }
    
    public function visitIndexExpr($context) {
        $type = $this->visitLValueAddress($context);
        if (strpos($type, '[') === false || $type[0] === '*') {
            $this->generator->addText("    ldr x1, [sp], 8"); // address
            if ($type === 'float32') {
                $this->generator->addText("    ldr s0, [x1]");
                $this->generator->addText("    fmov w0, s0");
            } else {
                $this->generator->addText("    ldr x0, [x1]");
            }
            $this->generator->addText("    str x0, [sp, -8]!");
        }
        return $type;
    }

    private function flattenArrayLiteral($context) {
        $elements = [];
        if ($context->arrayLiteral()) {
            foreach ($context->arrayLiteral() as $childArr) {
                $elements = array_merge($elements, $this->flattenArrayLiteral($childArr));
            }
        }
        if ($context->expression()) {
            foreach ($context->expression() as $expr) {
                if (method_exists($expr, 'arrayLiteral') && $expr->arrayLiteral() !== null) {
                    $elements = array_merge($elements, $this->flattenArrayLiteral($expr->arrayLiteral()));
                } else {
                    $elements[] = $expr;
                }
            }
        }
        return $elements;
    }

    public function visitArrayLitExpr($context) {
        $elements = $this->flattenArrayLiteral($context->arrayLiteral());
        $size = count($elements);
        
        $type = "";
        $lit = $context->arrayLiteral();
        if ($lit->arraySizes() !== null) {
            $type = $lit->arraySizes()->getText() . $lit->type()->getText();
        } else if ($lit->type() !== null) {
            $innerType = $lit->type()->getText();
            if ($innerType[0] === '[') $type = $innerType;
            else $type = "[$size]" . $innerType;
        } else {
            $type = "[$size]int32";
            if ($size > 0) {
                $firstElem = $elements[0];
                if (method_exists($firstElem, 'FLOAT_LIT')) $type = "[$size]float32";
            }
        }
        $type = trim($type);
        
        $label = $this->generator->newLabel("L_arr_");
        $this->generator->addData($label, ".skip", $size * 8);
        
        $this->generator->addText("    adrp x10, $label");
        $this->generator->addText("    add x10, x10, :lo12:$label");
        $this->generator->addText("    str x10, [sp, -8]!"); // push base address
        
        for ($i = 0; $i < $size; $i++) {
            $this->visit($elements[$i]);
            $this->generator->addText("    ldr x0, [sp], 8");
            $this->generator->addText("    ldr x10, [sp]"); // PEEK base address
            $this->generator->addText("    str x0, [x10, " . ($i * 8) . "]");
        }
        
        return $type; 
    }

    public function visitAddSubExpr($context) {
        $t1 = $this->visit($context->expression(0));
        $t2 = $this->visit($context->expression(1));
        $this->generator->addText("    ldr x1, [sp], 8");
        $this->generator->addText("    ldr x0, [sp], 8");
        $op = $context->getChild(1)->getText();
        
        if ($t1 === 'float32' || $t2 === 'float32') {
            if ($t1 === 'int32') $this->generator->addText("    scvtf s0, w0");
            else $this->generator->addText("    fmov s0, w0");
            
            if ($t2 === 'int32') $this->generator->addText("    scvtf s1, w1");
            else $this->generator->addText("    fmov s1, w1");
            
            if ($op === '+') $this->generator->addText("    fadd s0, s0, s1");
            else $this->generator->addText("    fsub s0, s0, s1");
            
            $this->generator->addText("    fmov w0, s0");
            $this->generator->addText("    str x0, [sp, -8]!");
            return 'float32';
        } else {
            if ($op === '+') $this->generator->addText("    add w0, w0, w1");
            else $this->generator->addText("    sub w0, w0, w1");
            $this->generator->addText("    sxtw x0, w0");
            $this->generator->addText("    str x0, [sp, -8]!");
            return 'int32';
        }
    }
    
    public function visitMulDivExpr($context) {
        $t1 = $this->visit($context->expression(0));
        $t2 = $this->visit($context->expression(1));
        $this->generator->addText("    ldr x1, [sp], 8");
        $this->generator->addText("    ldr x0, [sp], 8");
        $op = $context->getChild(1)->getText();
        
        if ($t1 === 'float32' || $t2 === 'float32') {
            if ($t1 === 'int32') $this->generator->addText("    scvtf s0, w0");
            else $this->generator->addText("    fmov s0, w0");
            
            if ($t2 === 'int32') $this->generator->addText("    scvtf s1, w1");
            else $this->generator->addText("    fmov s1, w1");
            
            if ($op === '*') $this->generator->addText("    fmul s0, s0, s1");
            else if ($op === '/') $this->generator->addText("    fdiv s0, s0, s1");
            
            $this->generator->addText("    fmov w0, s0");
            $this->generator->addText("    str x0, [sp, -8]!");
            return 'float32';
        } else {
            if ($op === '*') $this->generator->addText("    mul w0, w0, w1");
            else if ($op === '/') $this->generator->addText("    sdiv w0, w0, w1");
            else if ($op === '%') {
                $this->generator->addText("    sdiv w2, w0, w1");
                $this->generator->addText("    msub w0, w2, w1, w0");
            }
            $this->generator->addText("    sxtw x0, w0");
            $this->generator->addText("    str x0, [sp, -8]!");
            return 'int32';
        }
    }
    
    public function visitEqualityExpr($context) {
        $t1 = $this->visit($context->expression(0));
        $t2 = $this->visit($context->expression(1));
        $this->generator->addText("    ldr x1, [sp], 8");
        $this->generator->addText("    ldr x0, [sp], 8");
        $this->generator->addText("    cmp x0, x1");
        if ($context->getChild(1)->getText() === '==') $this->generator->addText("    cset x0, eq");
        else $this->generator->addText("    cset x0, ne");
        $this->generator->addText("    str x0, [sp, -8]!");
        if ($t1 === 'nil' && $t2 === 'nil') return 'nil';
        return 'bool';
    }
    
    public function visitRelationalExpr($context) {
        $t1 = $this->visit($context->expression(0));
        $t2 = $this->visit($context->expression(1));
        $this->generator->addText("    ldr x1, [sp], 8");
        $this->generator->addText("    ldr x0, [sp], 8");
        $op = $context->getChild(1)->getText();
        
        if ($t1 === 'nil' && $t2 === 'nil' && $op === '==') {
            $label = $this->generator->newLabel("L_nil_res_");
            $this->generator->addData($label, ".asciz", "\"<nil>\"");
            $this->generator->addText("    adrp x0, $label");
            $this->generator->addText("    add x0, x0, :lo12:$label");
            $this->generator->addText("    str x0, [sp, -8]!");
            return 'string';
        }
        
        if ($t1 === 'float32' || $t2 === 'float32') {
            if ($t1 === 'int32') $this->generator->addText("    scvtf s0, w0");
            else $this->generator->addText("    fmov s0, w0");
            
            if ($t2 === 'int32') $this->generator->addText("    scvtf s1, w1");
            else $this->generator->addText("    fmov s1, w1");
            
            $this->generator->addText("    fcmp s0, s1");
        } else {
            $this->generator->addText("    cmp x0, x1");
        }
        
        if ($op === '>') $this->generator->addText("    cset x0, gt");
        else if ($op === '>=') $this->generator->addText("    cset x0, ge");
        else if ($op === '<') $this->generator->addText("    cset x0, lt");
        else if ($op === '<=') $this->generator->addText("    cset x0, le");
        $this->generator->addText("    str x0, [sp, -8]!");
        return 'bool';
    }

    public function visitParenExpr($context) {
        return $this->visit($context->expression());
    }
    
    private function getIds($idListCtx) {
        $ids = [];
        if ($idListCtx !== null) {
            foreach ($idListCtx->ID() as $idNode) {
                $ids[] = $idNode->getText();
            }
        }
        return $ids;
    }
}