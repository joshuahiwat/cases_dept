<?php

require __DIR__ .'/vendor/autoload.php';

use lib\utils\rest;

$rest = new rest(
    '123',
    'hello',
    [
        'method' => 'titles',
        'searchName' => 'mutants',
        'amount' => 4,
        'titleName' => 'gta',
    ]
);
print_r($rest->run());