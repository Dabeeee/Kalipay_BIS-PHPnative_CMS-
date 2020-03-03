<?php
require '../vendor/autoload.php';

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;

// Configure client
$config = Configuration::getDefaultConfiguration();
$config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU1MDY0NzkzMSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjY4MzAzLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.t-x91N95O3-dSO7SDsYMbK0Yy4p1mvDuHVdg0dBimVg');
$apiClient = new ApiClient($config);
$messageClient = new MessageApi($apiClient);

// Sending a SMS Message
$sendMessageRequest1 = new SendMessageRequest([
    'phoneNumber' => '09092411741',
    'message' => 'test1',
    'deviceId' =>109565
]);

$sendMessages = $messageClient->sendMessages([
    $sendMessageRequest1,
  
]);
		

?>