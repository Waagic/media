<?php


namespace App\Service\API;


use Symfony\Component\HttpClient\HttpClient;

class RAWGManager
{
    public function searchVideoGame($string)
    {
        $response = $this->client->request('GET', 'https://api.rawg.io/api/games?search=' . $string);
        $results = $response->toArray();
        return $results;
    }
}