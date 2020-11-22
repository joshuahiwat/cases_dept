<?php


namespace lib\logic;

use lib\helpers\cache;
use lib\helpers\outsideModule;

/**
 * Class movies
 *
 * @package lib\logic
 */
class movies
{
    const BASE_URL = 'https://youtube-search-results.p.rapidapi.com/'; // Base url from the api connector
    const HOST = 'youtube-search-results.p.rapidapi.com'; // Host to connect to receive data
    const KEY = '2308d820cemsh687ef937bcf956ap1e75f4jsn091ee7946466'; // API key to connect with the host

    /**
     * @var string
     */
    private string $title;

    /**
     * movies constructor.
     *
     * @param string $title Title of the movie
     */
    public function __construct(
        string $title
    )
    {
        $this->title = $title;
    }

    /**
     * Get movies from a host select by title name
     *
     * @return false|string
     */
    public function getMovie()
    {
        $cache = new cache(
            'movies',
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

        $movie = $request->getRequest(
            'youtube-search/?q=' . urlencode($this->title)
        );

        $cache->setCache(json_encode($movie));
        return $cache->getCache();
    }
}