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
     * @var object
     */
    private object $data;

    /**
     * middleWare constructor.
     *
     * @param object $data Bundle of data what can be used to call a method of for some call to actions
     */
    public function __construct(object $data)
    {
        $this->data = $data;
    }

    /**
     * Select method and give the right data back
     *
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
                case 'search':
                    return $this->getTitleSearchByName();
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

    /**
     * @return array|bool
     */
    private function getTitleSearchByName()
    {
        $imdb = new titles();
        return $imdb->getTitleByName($this->data->searchName);
    }
}