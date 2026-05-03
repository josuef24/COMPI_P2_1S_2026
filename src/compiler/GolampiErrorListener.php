<?php

namespace Golampi\compiler;

use Antlr\Antlr4\Runtime\Error\Listeners\BaseErrorListener;
use Antlr\Antlr4\Runtime\Recognizer;
use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;

class GolampiErrorListener extends BaseErrorListener {
    private $errorReport;
    private $isLexer;

    public function __construct($errorReport, $isLexer = false) {
        $this->errorReport = $errorReport;
        $this->isLexer = $isLexer;
    }

    public function syntaxError(
        Recognizer $recognizer,
        ?object $offendingSymbol,
        int $line,
        int $charPositionInLine,
        string $msg,
        ?RecognitionException $e
    ) : void {
        $type = $this->isLexer ? 'Léxico' : 'Sintáctico';
        $this->errorReport->addError($type, $msg, $line, $charPositionInLine);
    }
}
