<?php


namespace App\Service\API;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class DeezerManager
{
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function searchAlbums($string)
    {
        $response = $this->client->request('GET', 'https://api.deezer.com/search/album?q='.$string);
        $results = $response->toArray();
        return $results;
    }
}