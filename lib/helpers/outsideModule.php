<?php

namespace lib\helpers;

/**
 * Class Imdb
 *
 * @package Lib\Helpers
 */
class outsideModule implements outsideModuleTemplate
{
    /**
     * @var string
     */
    private string $baseUrl;
    /**
     * @var string
     */
    private string $host;
    /**
     * @var string
     */
    private string $key;

    /**
     * outsideModule constructor.
     *
     * @param string $baseUrl
     * @param string $host
     * @param string $key
     */
    public function __construct(string $baseUrl, string $host, string $key)
    {
        $this->baseUrl = $baseUrl;
        $this->host = $host;
        $this->key = $key;
    }

    /**
     * Create curl request and get data from IMDB
     *
     * @param string $request
     * @return array|bool
     */
    public function getRequest(string $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->baseUrl . $request,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: " . $this->host,
                "x-rapidapi-key: " . $this->key
            ],
        ]);

        $response = curl_exec($curl);
        $message = curl_error($curl);

        curl_close($curl);

        if ($message) {
            return false;
        } else {
            return json_decode($response, true);
        }
    }
}