<?php

namespace lib\logic;

use lib\helpers\cache;
use lib\helpers\outsideModule;

/**
 * Class movies
 *
 * @package Lib\Logic
 */
class titles
{
    const BASE_URL = 'https://imdb8.p.rapidapi.com/'; // Base url from the api connector
    const HOST = 'imdb8.p.rapidapi.com'; // Host to connect to receive data
    const KEY = '2308d820cemsh687ef937bcf956ap1e75f4jsn091ee7946466'; // API key to connect with the host

    /**
     * Get All movie titles by a specific genre
     *
     * @param object $data
     * @return string
     */
    public function getTitlesByGenre(
        object $data
    )
    {
        $cache = new cache(
            'titles',
            date("Ymd")
        );
        if ($cache->getCache()) {
            return $cache->getCache();
        }

        $request = new outsideModule(
            self::BASE_URL,
            self::HOST,
            self::KEY
        );

        $data->amount = isset($data->amount) ? $data->amount : null;
        $data->genre = isset($data->genre) ? $data->genre : null;

        $titles = $request->getRequest(
            'title/get-popular-movies-by-genre?genre=' . $data->genre
        );

        $bundle = [];
        foreach (array_slice($titles, 0, $data->amount) as $title)
        {
            $bundle[] = $request->getRequest(
                'title/get-details?tconst=' . substr($title, 7)
            );
        }

        $cache->setCache(json_encode($bundle));
        return $cache->getCache();
    }
}