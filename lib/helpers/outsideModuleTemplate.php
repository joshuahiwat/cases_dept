<?php

namespace lib\helpers;

/**
 * Interface imdbTemplate
 *
 * @package Lib\Helpers
 */
interface outsideModuleTemplate
{
    /**
     * Create curl request and get data from IMDB
     *
     * @param string $request
     * @return bool|string
     */
    public function getRequest(string $request);
}