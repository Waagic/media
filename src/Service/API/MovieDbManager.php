<?php


namespace App\Service\API;


use Symfony\Component\HttpClient\HttpClient;

class MovieDbManager
{
    protected $baseUrl = "https://api.themoviedb.org/3/";

    public function __construct()
    {
        $this->client = HttpClient::create([
            'auth_bearer' => 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhMGEwMDlmZjg2Y2IxZDA3YWJjMjIyZjM5MzM0ZjRmYSIsInN1YiI6IjVlOGI0NmM3ZmZkNDRkMDAxNTFhZTdlMiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.0MrGtbYZmmFVVHS5Nighnny0Ol5sQWEdgvWGgDgL2QM'
        ]);
    }

    public function searchMovies($string)
    {
        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/search/movie?query=' . $string);
        $results = $response->toArray();
        return $results;
    }
}