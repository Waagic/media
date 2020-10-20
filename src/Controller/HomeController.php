<?php

// src/Controller/HomeController.php
namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Repository\MovieRepository;
use App\Repository\SerieRepository;
use App\Repository\VideoGameRepository;
use App\Service\API\MovieDbManager;
use App\Service\API\RAWGManager;
use App\Service\API\SpotifyManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param MovieRepository $movieRepository
     * @param SerieRepository $serieRepository
     * @param VideoGameRepository $gameRepository
     * @param AlbumRepository $albumRepository
     * @return Response
     */
    public function index(MovieRepository $movieRepository, SerieRepository $serieRepository, VideoGameRepository $gameRepository, AlbumRepository $albumRepository): Response
    {
        $movies = $movieRepository->findAll();
        $series = $serieRepository->findAll();
        $games = $gameRepository->findAll();
        $albums = $albumRepository->findAll();
        return $this->render('index.html.twig', [
            'movies' => $movies,
            'series' => $series,
            'games' => $games,
            'albums' => $albums
        ]);
    }

    /**
     * @Route("/movies/search", name="search_movies")
     * @param Request $request
     * @param MovieDbManager $movieDb
     * @return Response
     */
    public function searchMovies(Request $request, MovieDbManager $movieDb): Response
    {
        $search = $request->get("search");
        $results = $movieDb->searchMovies($search);
        return $this->render('movies_results.html.twig', [
            'results' => $results
        ]);
    }

    /**
     * @Route("/series/search", name="search_series")
     * @param Request $request
     * @param MovieDbManager $movieDb
     * @return Response
     */
    public function searchSeries(Request $request, MovieDbManager $movieDb): Response
    {
        $search = $request->get("search");
        $results = $movieDb->searchSeries($search);
        return $this->render('series_results.html.twig', [
            'results' => $results
        ]);
    }

    /**
     * @Route("/videogames/search", name="search_videogames")
     * @param Request $request
     * @param RAWGManager $rawg
     * @return Response
     */
    public function searchVideoGames(Request $request, RAWGManager $rawg): Response
    {
        $search = $request->get("search");
        $results = $rawg->searchVideoGame($search);
        return $this->render('videogames_results.html.twig', [
            'results' => $results
        ]);
    }

    /**
     * @Route("/albums/search", name="search_albums")
     * @param Request $request
     * @param SpotifyManager $spotify
     * @return Response
     */
    public function searchAlbums(Request $request, SpotifyManager $spotify): Response
    {
        $search = $request->get("search");
        $results = $spotify->searchAlbums($search);
        return $this->render('albums_results.html.twig', [
            'results' => $results
        ]);
    }
}