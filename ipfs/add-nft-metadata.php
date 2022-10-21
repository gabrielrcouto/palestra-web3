<?php

require('../vendor/autoload.php');

use Rootsoft\IPFS\Clients\IPFSClient;

$ipfs = new IPFSClient('127.0.0.1', 5001);

var_dump($ipfs->add(file_get_contents('../03-nft/nft-metadata.json'), 'nft-metadata.json', ['pin' => true]));
