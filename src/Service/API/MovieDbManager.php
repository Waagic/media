<?php


namespace App\Service\API;


use Symfony\Component\HttpClient\HttpClient;

class MovieDbManager
{
    protected $baseUrl = "https://api.themoviedb.org/3/";

    public function __construct(string $movieDbApiKey)
    {
        $this->client = HttpClient::create([
            'auth_bearer' => $movieDbApiKey
        ]);
    }

    public function searchMovies($string)
    {
        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/search/movie?query=' . $string);
        $results = $response->toArray();
        return $results;
    }

    public function searchSeries($string)
    {
        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/search/tv?query=' . $string);
        $results = $response->toArray();
        return $results;
    }
}