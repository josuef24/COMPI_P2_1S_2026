<?php
require_once __DIR__ . '/vendor/autoload.php';

use Golampi\compiler\GolampiCompiler;
use Golampi\reports\ErrorReport;
use Golampi\reports\SymbolReport;

$sourceCode = "var x int32 = 10;";
$errorReport = new ErrorReport();
$symbolReport = new SymbolReport();

$compiler = new GolampiCompiler($errorReport, $symbolReport);

try {
    $arm64Code = $compiler->compile($sourceCode);
    echo "Success!\n";
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
