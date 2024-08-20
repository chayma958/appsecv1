<?php

use Illuminate\Support\Facades\DB;
use App\Models\ModsecurityNotification;

// Include the Laravel framework
require __DIR__ . '/../bootstrap/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Get the JSON input from ModSecurity
$jsonInput = file_get_contents('php://input');
$data = json_decode($jsonInput, true);

// Extract relevant information from the ModSecurity alert
if (isset($data['transaction']['messages'][0])) {
    $ruleId = $data['transaction']['messages'][0]['message']['ruleId'] ?? 'unknown';
    $message = $data['transaction']['messages'][0]['message']['message'] ?? 'No message';

    // Insert the alert into the database
    ModsecurityNotification::create([
        'rule_id' => $ruleId,
        'message' => $message,
    ]);
}

// Return a response to ModSecurity
header('Content-Type: application/json');
echo json_encode(['status' => 'success']);
