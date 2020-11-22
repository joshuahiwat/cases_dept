<?php

namespace lib\logic;

/**
 * Class middleWare
 *
 * @package Lib\logic
 */
final class middleWare
{
    /**
     * @var string
     */
    private string $type;
    /**
     * @var object
     */
    private object $data;

    /**
     * middleWare constructor.
     *
     * @param string $type
     * @param object $data
     */
    public function __construct(string $type, object $data)
    {
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function run()
    {
        if ( isset( $this->data->method ) ) {
            switch ( $this->data->method )
            {
                case 'titles':
                    return $this->getMovieTitles();
                case 'movies':
                    return $this->getMovies();
                default:
                    return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Get movie titles by name
     *
     * @return string
     */
    private function getMovieTitles()
    {
        $imdb = new titles();
        return $imdb->getTitlesByGenre($this->data);
    }

    /**
     * Get movies by title name
     *
     * @return false|string
     */
    private function getMovies()
    {
        $youtube = new movies(
            $this->data->titleName
        );
        return $youtube->getMovie();
    }
}