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
     * @var string
     */
    private string $credentials;
    /**
     * @var array
     */
    private array $data;

    /**
     * Rest constructor.
     *
     * @param string $credentials Credentials of the api
     * @param array $data Bundle of data what can be used to call a method of for some call to actions
     */
    public function __construct(
        string $credentials,
        array $data
    )
    {
        $this->credentials = $credentials;
        $this->data = $data;
    }

    /**
     * Run API rest method and get request data
     *
     * @return false|middleWare
     */
    public function run()
    {
        if($this->getCredentials()) {
            $middleware = new middleWare(
                (object) $this->data
            );
            return $middleware->run();
        }
        return false;
    }

    /**
     * Check if credentials are correct
     *
     * @return bool
     */
    private function getCredentials()
    {
        $Loader = new Loader('.env');
        $Loader->parse();
        $Loader->toEnv();

        if($this->credentials == $_ENV['key']) {
            return true;
        }
        return false;
    }
}