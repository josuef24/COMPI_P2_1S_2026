<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Golampi\compiler\GolampiCompiler;
use Golampi\reports\ErrorReport;
use Golampi\reports\SymbolReport;

if ($argc < 2) {
    die("Usage: php test_cli.php <file>\n");
}

$file = $argv[1];
$sourceCode = file_get_contents($file);

$errorReport = new ErrorReport();
$symbolReport = new SymbolReport();
$compiler = new GolampiCompiler($errorReport, $symbolReport);

$arm64Code = $compiler->compile($sourceCode);

if ($errorReport->hasErrors()) {
    echo "ERRORS:\n";
    print_r($errorReport->getErrors());
}

if ($arm64Code !== false) {
    echo "\nSUCCESS. Length: " . strlen($arm64Code) . "\n";
} else {
    echo "\nFAILED.\n";
}
