<?php

// src/Controller/HomeController.php
namespace App\Controller;

use App\Repository\MovieRepository;
use App\Service\API\MovieDbManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param MovieRepository $movieRepository
     * @return Response
     */
    public function index(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();
        return $this->render('index.html.twig', [
            'movies' => $movies
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
}