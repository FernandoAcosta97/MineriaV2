<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

$key = '';
$secret = '';

$client = new \Binance\Spot([
    'key'  => $key,
    'secret'  => $secret
]);

$response = $client->blvtSubscriptionRecord(
    [
        'tokenName' => 'BTCUP',
        'id' => 123,
        'startTime' => 1640995200000,
        'endTime' => 1640995200000,
        'limit' => 500,
        'recvWindow' => 5000
    ]
);

echo json_encode($response);
