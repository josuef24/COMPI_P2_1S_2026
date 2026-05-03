<?php
$content = <<<'EOF'
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
        foreach ($context->statement() as $stmt) {
            if ($stmt->funcDecl()) {
                $funcName = $stmt->funcDecl()->ID()->getText();
                $retTypeCtx = $stmt->funcDecl()->returnType();
                $retType = $retTypeCtx ? $retTypeCtx->getText() : 'void';
                $this->funcTable[$funcName] = $retType;
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
        preg_match_all('/\[(\d+)\]/', $type, $matches);
        $size = 1;
        foreach ($matches[1] as $dim) $size *= intval($dim);
        return $size * 8;
    }
    
    public function visitFuncDecl($context) {
        $funcName = $context->ID()->getText();
        $this->currentFunc = $funcName;
        $this->env->declare($funcName, 'func', true, 8, $context->start->getLine(), $context->start->getCharPositionInLine());
        
        $prevEnv = $this->env;
        $this->env = new Environment($prevEnv, 'func', new \stdClass());
        $this->env->getOffsetTracker()->offset = 0;
        
        $params = [];
        if ($context->paramList()) {
            foreach ($context->paramList()->param() as $paramCtx) {
                $params[] = ['id' => $paramCtx->ID()->getText(), 'type' => $paramCtx->type()->getText()];
            }
        }
        
        // Offset for parameters (passed on stack before stp x29, x30)
        // Reverse order because arg N is pushed last (closest to x29)
        $currentOffset = 16;
        for ($i = count($params) - 1; $i >= 0; $i--) {
            $paramSize = $this->calcArraySize($params[$i]['type']);
            $this->env->declareParam($params[$i]['id'], $params[$i]['type'], $currentOffset);
            $currentOffset += $paramSize;
        }
        
        $this->generator->addText("\n" . $funcName . ":");
        $this->generator->addText("    stp x29, x30, [sp, -16]!");
        $this->generator->addText("    mov x29, sp");
        
        $this->visit($context->block());
        
        $this->generator->addText(".L_end_func_$funcName:");
        $this->generator->addText("    mov sp, x29");
        $this->generator->addText("    ldp x29, x30, [sp], 16");
        $this->generator->addText("    ret");
        
        $this->env = $prevEnv;
        return null;
    }
    
    public function visitReturnStmt($context) {
        $funcRetType = isset($this->funcTable[$this->currentFunc]) ? $this->funcTable[$this->currentFunc] : 'void';
        $returnsArray = strpos($funcRetType, '[') !== false && $funcRetType[0] !== '*';
        
        if ($context->expList()) {
            $exprs = $context->expList()->expression();
            if ($returnsArray && count($exprs) === 1) {
                $this->visit($exprs[0]);
                $this->generator->addText("    ldr x1, [sp], 8");
                $sizeBytes = $this->calcArraySize($funcRetType);
                $size = $sizeBytes / 8;
                for ($i = 0; $i < $size; $i++) {
                    $this->generator->addText("    ldr x0, [x1, " . ($i * 8) . "]");
                    $this->generator->addText("    str x0, [x8, " . ($i * 8) . "]");
                }
            } else {
                $N = count($exprs);
                for ($i = 0; $i < $N; $i++) {
                    $this->visit($exprs[$i]);
                }
                for ($i = $N - 1; $i >= 0; $i--) {
                    $this->generator->addText("    ldr x$i, [sp], 8");
                }
            }
        }
        $this->generator->addText("    mov sp, x29");
        $this->generator->addText("    ldp x29, x30, [sp], 16");
        $this->generator->addText("    ret");
        return null;
    }
    
    public function visitFuncCallStmt($context) {
        $this->visitCallExpr($context);
        return null;
    }
    
    public function visitCallExpr($context) {
        $funcName = $context->expression() ? $context->expression()->getText() : $context->getChild(0)->getText();
        $exprs = $context->expList() ? $context->expList()->expression() : [];
        
        $retType = isset($this->funcTable[$funcName]) ? $this->funcTable[$funcName] : 'void';
        $returnsArray = strpos($retType, '[') !== false && $retType[0] !== '*';
        $arrayBytes = 0;
        if ($returnsArray) {
            $arrayBytes = $this->calcArraySize($retType);
            $this->generator->addText("    sub sp, sp, $arrayBytes");
            $this->generator->addText("    mov x8, sp");
        }
        
        $argsBytes = 0;
        foreach ($exprs as $expr) {
            $type = $this->visit($expr);
            if (strpos($type, '[') !== false && $type[0] !== '*') {
                $this->generator->addText("    ldr x1, [sp], 8");
                $sizeBytes = $this->calcArraySize($type);
                $size = $sizeBytes / 8;
                for ($i = $size - 1; $i >= 0; $i--) {
                    $this->generator->addText("    ldr x0, [x1, " . ($i * 8) . "]");
                    $this->generator->addText("    str x0, [sp, -8]!");
                }
                $argsBytes += $sizeBytes;
            } else {
                $argsBytes += 8;
            }
        }
        
        $this->generator->addText("    bl $funcName");
        
        if ($argsBytes > 0) {
            $this->generator->addText("    add sp, sp, $argsBytes");
        }
        
        if ($returnsArray) {
            $this->generator->addText("    mov x0, sp");
            $this->generator->addText("    str x0, [sp, -8]!");
            return $retType;
        } else {
            $this->generator->addText("    str x0, [sp, -8]!");
            return $retType;
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
        if ($expr->getChildCount() > 0 && $expr->getChild(0)->getText() === '*') {
            $ptrType = $this->visit($expr->expression(0));
            return str_replace('*', '', $ptrType);
        }
        if ($expr->getChildCount() >= 4 && $expr->getChild(1)->getText() === '[') {
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
            
            $this->generator->addText("    ldr x19, [sp], 8"); // array base address
            $this->generator->addText("    mov x20, 0"); // offset accumulator
            
            for ($i = 0; $i < count($indexExprs); $i++) {
                $this->visit($indexExprs[$i]);
                $this->generator->addText("    ldr x0, [sp], 8");
                $w = $weights[$i];
                $this->generator->addText("    mov x1, $w");
                $this->generator->addText("    mul x0, x0, x1");
                $this->generator->addText("    add x20, x20, x0");
            }
            
            $this->generator->addText("    mov x1, 8");
            $this->generator->addText("    mul x20, x20, x1");
            $this->generator->addText("    add x0, x19, x20"); // address
            $this->generator->addText("    str x0, [sp, -8]!"); // push address
            
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
        
        if (count($ids) == 2 && count($exprsRight) == 1) {
            $this->visit($exprsRight[0]);
            $this->generator->addText("    ldr x0, [sp], 8");
            $this->generator->addText("    str x1, [sp, -8]!");
            $this->generator->addText("    str x0, [sp, -8]!");
            $exprsRight = [1, 2];
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
            }
            
            $line = $context->start->getLine();
            $col = $context->start->getCharPositionInLine();
            
            if ($this->env->declare($id, $type, false, $sizeBytes, $line, $col)) {
                $sym = $this->env->get($id);
                if ($sym['isGlobal']) {
                    $this->generator->addData($sym['label'], ".skip", $sizeBytes);
                    $this->generator->addText("    adrp x1, " . $sym['label']);
                    $this->generator->addText("    add x1, x1, :lo12:" . $sym['label']);
                } else {
                    $this->generator->addText("    sub sp, sp, $sizeBytes");
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
            }
        }
        return null;
    }
    
    public function visitAssignment($context) {
        $exprsRight = $context->expList()->expression();
        $exprsLeft = $context->exprList()->expression();
        $op = $context->assignOp()->getText();
        
        for ($i = 0; $i < count($exprsLeft); $i++) {
            $type = $this->visitLValueAddress($exprsLeft[$i]);
            
            if ($op !== '=') {
                $this->generator->addText("    ldr x1, [sp], 8");
                $this->generator->addText("    ldr x0, [x1]");
                $this->generator->addText("    str x1, [sp, -8]!");
                $this->generator->addText("    str x0, [sp, -8]!");
            }
            
            $this->visit($exprsRight[$i]);
            
            if ($op !== '=') {
                $this->generator->addText("    ldr x1, [sp], 8");
                $this->generator->addText("    ldr x0, [sp], 8");
                if ($op === '+=') $this->generator->addText("    add x0, x0, x1");
                else if ($op === '-=') $this->generator->addText("    sub x0, x0, x1");
                else if ($op === '*=') $this->generator->addText("    mul x0, x0, x1");
                else if ($op === '/=') $this->generator->addText("    sdiv x0, x0, x1");
                $this->generator->addText("    ldr x1, [sp], 8");
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
            }
        }
        return null;
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
                else $this->generator->addText("    bl print_int");
                if ($i < $count - 1) $this->generator->addText("    bl print_space");
            }
            $this->generator->addText("    bl print_newline");
        } else if ($context->LEN() !== null) {
            $type = $this->visit($context->expression());
            if (strpos($type, '[') !== false) {
                preg_match('/\[(\d+)\]/', $type, $matches);
                $len = $matches ? $matches[1] : 0;
                $this->generator->addText("    ldr x0, [sp], 8");
                $this->generator->addText("    mov x0, $len");
                $this->generator->addText("    str x0, [sp, -8]!");
            } else {
                $this->generator->addText("    ldr x0, [sp], 8");
                $this->generator->addText("    mov x1, 0");
                $this->generator->addText(".L_len_loop_".uniqid().":");
                $this->generator->addText("    ldrb w2, [x0, x1]");
                $this->generator->addText("    cbz w2, .L_len_end_".uniqid());
                $this->generator->addText("    add x1, x1, 1");
                $this->generator->addText("    b .L_len_loop_".uniqid());
                $this->generator->addText(".L_len_end_".uniqid().":");
                $this->generator->addText("    str x1, [sp, -8]!");
            }
            return 'int32';
        }
        return null;
    }
    
    public function visitIntExpr($context) {
        $val = $context->INT_LIT()->getText();
        $this->generator->addText("    ldr x0, =$val");
        $this->generator->addText("    str x0, [sp, -8]!");
        return 'int32';
    }
    
    public function visitFloatExpr($context) {
        $val = intval(floatval($context->FLOAT_LIT()->getText()));
        $this->generator->addText("    ldr x0, =$val");
        $this->generator->addText("    str x0, [sp, -8]!");
        return 'float32';
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
        $this->generator->addText("    ldr x1, [sp], 8"); // address
        $this->generator->addText("    ldr x0, [x1]");
        $this->generator->addText("    str x0, [sp, -8]!");
        return $type;
    }

    private function flattenArrayLiteral($context) {
        $elements = [];
        if ($context->arrayLiteral()) {
            foreach ($context->arrayLiteral() as $childArr) {
                $elements = array_merge($elements, $this->flattenArrayLiteral($childArr));
            }
        } else if ($context->expression()) {
            foreach ($context->expression() as $expr) {
                $elements[] = $expr;
            }
        }
        return $elements;
    }

    public function visitArrayLitExpr($context) {
        $elements = $this->flattenArrayLiteral($context->arrayLiteral());
        $size = count($elements);
        
        $label = $this->generator->newLabel("L_arr_");
        $this->generator->addData($label, ".skip", $size * 8);
        
        $this->generator->addText("    adrp x19, $label");
        $this->generator->addText("    add x19, x19, :lo12:$label");
        
        for ($i = 0; $i < $size; $i++) {
            $this->visit($elements[$i]);
            $this->generator->addText("    ldr x0, [sp], 8");
            $this->generator->addText("    str x0, [x19, " . ($i * 8) . "]");
        }
        
        $this->generator->addText("    str x19, [sp, -8]!");
        
        // Basic type inference
        return "[$size]int32"; 
    }

    public function visitAddSubExpr($context) {
        $t = $this->visit($context->expression(0));
        $this->visit($context->expression(1));
        $this->generator->addText("    ldr x1, [sp], 8");
        $this->generator->addText("    ldr x0, [sp], 8");
        $op = $context->getChild(1)->getText();
        if ($op === '+') $this->generator->addText("    add x0, x0, x1");
        else $this->generator->addText("    sub x0, x0, x1");
        $this->generator->addText("    str x0, [sp, -8]!");
        return $t;
    }
    
    public function visitMulDivExpr($context) {
        $t = $this->visit($context->expression(0));
        $this->visit($context->expression(1));
        $this->generator->addText("    ldr x1, [sp], 8");
        $this->generator->addText("    ldr x0, [sp], 8");
        $op = $context->getChild(1)->getText();
        if ($op === '*') $this->generator->addText("    mul x0, x0, x1");
        else if ($op === '/') $this->generator->addText("    sdiv x0, x0, x1");
        else if ($op === '%') {
            $this->generator->addText("    sdiv x2, x0, x1");
            $this->generator->addText("    msub x0, x2, x1, x0");
        }
        $this->generator->addText("    str x0, [sp, -8]!");
        return $t;
    }
    
    public function visitEqualityExpr($context) {
        $this->visit($context->expression(0));
        $this->visit($context->expression(1));
        $this->generator->addText("    ldr x1, [sp], 8");
        $this->generator->addText("    ldr x0, [sp], 8");
        $this->generator->addText("    cmp x0, x1");
        if ($context->getChild(1)->getText() === '==') $this->generator->addText("    cset x0, eq");
        else $this->generator->addText("    cset x0, ne");
        $this->generator->addText("    str x0, [sp, -8]!");
        return 'bool';
    }
    
    public function visitRelationalExpr($context) {
        $this->visit($context->expression(0));
        $this->visit($context->expression(1));
        $this->generator->addText("    ldr x1, [sp], 8");
        $this->generator->addText("    ldr x0, [sp], 8");
        $this->generator->addText("    cmp x0, x1");
        $op = $context->getChild(1)->getText();
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
EOF;
file_put_contents('c:\Users\user.pc-1\Desktop\golampi 2.0\src\compiler\GolampiSemanticVisitor.php', $content);
