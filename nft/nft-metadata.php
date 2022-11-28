<?php

require('../vendor/autoload.php');

use Web3\Contract;
use Web3\Web3;

$web3 = new Web3('http://127.0.0.1:7545/');

$eth = $web3->eth;

$contractAddress = '0x8BF0c0F8dA9d046E3F1E63657E0f5bd47fBE384D';
$contract = new Contract($web3->provider, file_get_contents('abi.json'));
$nftId = 2;

$eth->accounts(function ($err, $accounts) use ($eth, $contract, $contractAddress, $nftId) {
    if ($err !== null) {
        echo 'Error: ' . $err->getMessage();
        return;
    }
    $fromAccount = $accounts[0];

    $contract->at($contractAddress)->call('tokenURI', $nftId, [
        'from' => $fromAccount,
    ], function ($err, $result) {
        if ($err !== null) {
            echo 'Error: ' . $err;
            return;
        }

        echo 'NFT URI ' . $result[0] . PHP_EOL;
    });
});
