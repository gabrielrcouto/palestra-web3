<?php

require('../vendor/autoload.php');

use Web3\Contract;
use Web3\Web3;

$web3 = new Web3('http://127.0.0.1:7545/');

$eth = $web3->eth;

$contractAddress = '0xF7D77cFAa49adb5659664B3D0266AE5f4FB58e4c';
$contract = new Contract($web3->provider, file_get_contents('abi.json'));

$eth->accounts(function ($err, $accounts) use ($eth, $contract, $contractAddress) {
    if ($err !== null) {
        echo 'Error: ' . $err->getMessage();
        return;
    }
    $fromAccount = $accounts[0];

    // change function state
    $contract->at($contractAddress)->send('store', 777, [
        'from' => $fromAccount,
    ], function ($err, $result) {
        if ($err !== null) {
            echo 'Error: ' . $err;
            return;
        }
        echo 'Stored value with success.' . PHP_EOL;
    });
});

// call contract function
$contract->at($contractAddress)->call('retrieve', function ($err, $result) {
    if ($err !== null) {
        echo 'Error: ' . $err;
        return;
    }
    echo 'Retrieved value: ' . $result[0] . PHP_EOL;
});
