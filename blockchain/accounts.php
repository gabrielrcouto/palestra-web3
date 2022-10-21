<?php

require('../vendor/autoload.php');

use Web3\Web3;

$web3 = new Web3('http://127.0.0.1:7545/');

$eth = $web3->eth;

echo 'Eth Get Account and Balance' . PHP_EOL;

$eth->accounts(function ($err, $accounts) use ($eth) {
    if ($err !== null) {
        echo 'Error: ' . $err->getMessage();
        return;
    }
    foreach ($accounts as $account) {
        echo 'Account: ' . $account . PHP_EOL;

        $eth->getBalance($account, function ($err, $balance) {
            if ($err !== null) {
                echo 'Error: ' . $err->getMessage();
                return;
            }
            echo 'Balance: ' . $balance . PHP_EOL;
        });
    }
});
