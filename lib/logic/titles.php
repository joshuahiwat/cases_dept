<?php

namespace lib\logic;

use josegonzalez\Dotenv\Loader;
use lib\helpers\cache;
use lib\helpers\outsideModule;

/**
 * Class movies
 *
 * @package Lib\Logic
 */
class titles
{
    /**
     * Get All movie titles by a specific genre
     *
     * @param object $data All data that can be used to receive data from api
     * @return string
     */
    public function getTitlesByGenre(
        object $data
    ): string
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
        foreach (array_slice($titles, 0, $data->amount) as $title) // @todo fix that amount will be saved under cache
        {
            $bundle[] = $request->getRequest(
                'title/get-details?tconst=' . substr($title, 7)
            );
        }

        $cache->setCache(json_encode($bundle));
        return $cache->getCache();
    }

    /**
     * Search movie title by name and retrieve all details
     *
     * @param string|null $name Title name of the movie
     * @return array|bool
     */
    public function getTitleByName(string $name = null)
    {
        $Loader = new Loader('.env');
        $Loader->parse();
        $Loader->toEnv(true);

        if(empty($name)) {
            return false;
        }

        $cache = new cache(
            'titles',
            date("Ymd")
        );
        $titles = json_decode($cache->getCache(), true);

        $request = new outsideModule(
            $_ENV['BASE_URL'],
            $_ENV['HOST'],
            $_ENV['KEY']
        );

        foreach ($titles as $title) {
            if ( strpos(strtolower($title['title']), strtolower($name) ) !== false ) {
                return $request->getRequest(
                    'title/get-details?tconst=' . substr($title['id'], 7));
            } else {
                return false;
            }
        }
    }
}