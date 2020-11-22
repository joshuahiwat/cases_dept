<?php


namespace lib\helpers;


class cache
{
    private string $name;
    private $currentDate;

    public function __construct(
        string $name,
        $date
    )
    {
        $this->name = $name;
        $this->currentDate = $date;
    }

    public function setCache(string $json)
    {
        file_put_contents( $this->name . '_' . date("Ymd") . '.json', $json );
    }

    public function getCache()
    {
        if ( file_exists( $this->name . '_' . $this->currentDate . '.json' ) ) {
            return file_get_contents( $this->name . '_' . date("Ymd") . '.json' );
        } else {
            return false;
        }
    }
}