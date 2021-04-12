<?php

namespace lib\utils;

use josegonzalez\Dotenv\Loader;
use lib\logic\middleWare;

/**
 * Class Rest
 * @package Lib\Utils
 */
final class rest
{
    /**
     * Run API rest method and get request data
     *
     * @param string $credentials
     * @param string $data
     * @return false|middleWare
     */
    public function run(string $credentials, string $data)
    {
        if($this->getCredentials($credentials)) {
            $middleware = new middleWare(
                (object) json_decode($data, true)
            );
            return $middleware->run();
        }
        return false;
    }

    /**
     * Check if credentials are correct
     *
     * @param string $credentials
     * @return bool
     */
    private function getCredentials(string $credentials): bool
    {
        $Loader = new Loader('.env');
        $Loader->parse();
        $Loader->toEnv(true);

        if($credentials == $_ENV['key']) {
            return true;
        }
        return false;
    }
}