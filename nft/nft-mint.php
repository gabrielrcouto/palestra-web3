<?php

require('../vendor/autoload.php');

use Web3\Contract;
use Web3\Web3;
use Web3\Formatters\NumberFormatter;

$web3 = new Web3('http://127.0.0.1:7545/');

$eth = $web3->eth;

$contractAddress = '0x8BF0c0F8dA9d046E3F1E63657E0f5bd47fBE384D';
$contract = new Contract($web3->provider, file_get_contents('abi.json'));
$nftMetadataURI = 'ipfs://something-2';

$eth->accounts(function ($err, $accounts) use ($eth, $contract, $contractAddress, $nftMetadataURI) {
    if ($err !== null) {
        echo 'Error: ' . $err->getMessage();
        return;
    }
    $fromAccount = $accounts[0];
    $toNFT = $accounts[0];

    var_dump($fromAccount);

    $contract->at($contractAddress)->send('mintNFT', $toNFT, $nftMetadataURI, [
        'from' => $fromAccount,
    ], function ($err, $transactionId) use ($contract) {
        if ($err !== null) {
            echo 'Error: ' . $err;
            return;
        }

        echo 'Minted NFT. Transaction ID ' . $transactionId . PHP_EOL;
    });
});
