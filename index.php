<?php

require __DIR__ .'/vendor/autoload.php';

use lib\utils\rest;

$rest = new rest(
    'lol',
    'hello',
    [
        'method' => 'movies',
        'amount' => 4,
        'titleName' => 'gta',
    ]
);
var_dump($rest->run());