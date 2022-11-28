<?php
require('../vendor/autoload.php');

use Web3\Contract;
use Web3\Web3;
use Web3\Formatters\NumberFormatter;

$web3 = new Web3('http://127.0.0.1:7545/');

$eth = $web3->eth;
$contractAddress = '0x8BF0c0F8dA9d046E3F1E63657E0f5bd47fBE384D';
$contract = new Contract($web3->provider, file_get_contents('abi.json'));
$transactionId = '0x6dd2199676581b0778493356c5c7fbc1b0513b9ad464a08809c45c92148d8d00';

$contract->eth->getTransactionReceipt($transactionId, function ($err, $transaction) {
    if ($err !== null) {
        throw $err;
    }

    var_dump($transaction);

    if ($transaction) {
        echo 'NFT ID: ' . NumberFormatter::format($transaction->logs[0]->topics[3]) . PHP_EOL;
    }
});
