<?php

require __DIR__ .'/vendor/autoload.php';

use lib\utils\rest;
use RestService\Server;

Server::create('/', new rest)
    ->setDebugMode(true)
    ->addGetRoute('api', 'run')
    ->run();