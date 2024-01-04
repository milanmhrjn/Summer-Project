<?php
$payload = file_get_contents("php://input");
$token = "your_webhook_token"; // Replace with your webhook token
$headers = apache_request_headers();

if ($headers['Authorization'] === $token) {
    $payloadArray = json_decode($payload, true);
    
    // Process the payment details in $payloadArray
    
    http_response_code(200);
    echo json_encode(["message" => "Webhook received successfully"]);
} else {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
}
?>
