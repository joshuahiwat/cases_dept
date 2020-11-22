<?php

require __DIR__ .'/vendor/autoload.php';

use lib\utils\rest;

$rest = new rest(
    '123',
    'hello',
    [
        'method' => 'movies',
        'amount' => 4,
        'titleName' => 'gta',
    ]
);
var_dump($rest->run());