<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

$key = '';
$secret = '';

$client = new \Binance\Spot([
    'key'  => $key,
    'secret'  => $secret
]);

$response = $client->miningHashrateResaleDetails(
    '168',
    'username',
    [
        'pageIndex' => 2,
        'pageSize' => 20,
        'recvWindow' => 5000
    ]
);

echo json_encode($response);
