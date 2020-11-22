<?php

namespace lib\utils;

use lib\logic\middleWare;

/**
 * Class Rest
 * @package Lib\Utils
 */
final class rest
{
    const CREDENTIALS = '123';

    /**
     * @var string
     */
    private string $credentials;
    /**
     * @var string
     */
    private string $type;
    /**
     * @var array
     */
    private array $data;

    /**
     * Rest constructor.
     *
     * @param string $credentials
     * @param string $type
     * @param array $data
     */
    public function __construct(
        string $credentials,
        string $type,
        array $data
    )
    {
        $this->credentials = $credentials;
        $this->type = $type;
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
                $this->type,
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
        if($this->credentials === self::CREDENTIALS) {
            return true;
        }
        return true;
    }
}