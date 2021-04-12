<?php

use josegonzalez\Dotenv\Loader;

/**
 * Class api
 */
class api
{
    /**
     * @var string
     */
    private string $credentials;

    /**
     * api constructor.
     *
     * @param string $credentials
     */
    public function __construct(string $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @param array $data
     * @return bool|string
     */
    public function getApiData(array $data)
    {
        $curl = curl_init();
        $Loader = new Loader('.env');
        $Loader->parse();
        $Loader->toEnv(true);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $_ENV['URL'] . $this->credentials . "&data=" . urlencode(json_encode($data)),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }
}