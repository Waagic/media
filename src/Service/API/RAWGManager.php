<?php


namespace App\Service\API;


use Symfony\Contracts\HttpClient\HttpClientInterface;

class RAWGManager
{
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function searchVideoGame($string)
    {
        $response = $this->client->request('GET', 'https://api.rawg.io/api/games?search=' . $string);
        $results = $response->toArray();
        return $results;
    }
}