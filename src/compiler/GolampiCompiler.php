<?php

namespace Golampi\compiler;

use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenStream;
use Golampi\GolampiLexer;
use Golampi\GolampiParser;

class GolampiCompiler {
    private $errorReport;
    private $symbolReport;
    private $generator;
    
    public function __construct($errorReport, $symbolReport) {
        $this->errorReport = $errorReport;
        $this->symbolReport = $symbolReport;
        $this->generator = new ARM64Generator();
    }
    
    public function compile($sourceCode) {
        // Setup ANTLR lexer and parser
        $input = InputStream::fromString($sourceCode);
        $lexer = new GolampiLexer($input);
        
        $lexer->removeErrorListeners();
        $lexer->addErrorListener(new GolampiErrorListener($this->errorReport, true));
        
        $tokens = new CommonTokenStream($lexer);
        $parser = new GolampiParser($tokens);
        
        $parser->removeErrorListeners();
        $parser->addErrorListener(new GolampiErrorListener($this->errorReport, false));
        
        // Parse the program
        $tree = $parser->program();
        
        if ($this->errorReport->hasErrors()) {
            return false; // Stop if syntax/lexical errors
        }
        
        // Semantic Analysis and Code Gen
        $visitor = new GolampiSemanticVisitor($this->errorReport, $this->symbolReport, $this->generator);
        $visitor->visit($tree);
        
        if ($this->errorReport->hasErrors()) {
            return false; // Stop if semantic errors
        }
        
        return $this->generator->getCode();
    }
}
