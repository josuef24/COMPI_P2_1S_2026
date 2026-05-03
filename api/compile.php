<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Golampi\compiler\GolampiCompiler;
use Golampi\reports\ErrorReport;
use Golampi\reports\SymbolReport;

header('Content-Type: application/json');

// For CORS if needed
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    if (isset($data['code'])) {
        $sourceCode = $data['code'];
        
        $errorReport = new ErrorReport();
        $symbolReport = new SymbolReport();
        
        $compiler = new GolampiCompiler($errorReport, $symbolReport);
        
        try {
            $arm64Code = $compiler->compile($sourceCode);
            
            $response = [
                'success' => $arm64Code !== false,
                'assembly' => $arm64Code,
                'hasErrors' => $errorReport->hasErrors(),
                'errorsHtml' => $errorReport->generateHtml(),
                'symbolsHtml' => $symbolReport->generateHtml()
            ];
            
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'error' => "Compiler exception: " . $e->getMessage()
            ]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'No code provided']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
