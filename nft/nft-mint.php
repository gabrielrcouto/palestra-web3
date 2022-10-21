<?php

require('../vendor/autoload.php');

use Web3\Contract;
use Web3\Web3;
use Web3\Formatters\NumberFormatter;

$web3 = new Web3('http://127.0.0.1:7545/');

$eth = $web3->eth;

$contractAddress = '0x9A60A58393243c77FFcc42d84Fa8775217332D8C';
$contract = new Contract($web3->provider, file_get_contents('abi.json'));
$nftMetadataURI = 'ipfs://some-hash-2';

$eth->accounts(function ($err, $accounts) use ($eth, $contract, $contractAddress, $nftMetadataURI) {
    if ($err !== null) {
        echo 'Error: ' . $err->getMessage();
        return;
    }
    $fromAccount = $accounts[0];
    $toNFT = $accounts[0];

    $contract->at($contractAddress)->send('mintNFT', $toNFT, $nftMetadataURI, [
        'from' => $fromAccount,
    ], function ($err, $transactionId) use ($contract) {
        if ($err !== null) {
            echo 'Error: ' . $err;
            return;
        }

        echo 'Minted NFT. Transaction ID ' . $transactionId . PHP_EOL;

        $contract->eth->getTransactionReceipt($transactionId, function ($err, $transaction) {
            if ($err !== null) {
                throw $err;
            }
            if ($transaction) {
                echo 'NFT ID: ' . NumberFormatter::format($transaction->logs[0]->topics[3]) . PHP_EOL;
            }
        });
    });
});
