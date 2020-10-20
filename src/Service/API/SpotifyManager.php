<?php


namespace App\Service\API;


use Symfony\Component\HttpClient\HttpClient;

class SpotifyManager
{
    public function __construct(string $spotifyApiKey)
    {
        $this->client = HttpClient::create([
            'auth_bearer' => $spotifyApiKey
        ]);
    }

    public function searchAlbums($string)
    {
        $response = $this->client->request('GET', 'https://api.spotify.com/v1/search?q='.$string.'&type=album&market=FR');
        $results = $response->toArray();
        var_dump($results);
        return $results;
    }
}