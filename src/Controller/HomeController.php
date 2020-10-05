<?php

// src/Controller/HomeController.php
namespace App\Controller;

use App\Repository\MoviesRepository;
use App\Service\API\MovieDbManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param MoviesRepository $moviesRepository
     * @return Response
     */
    public function index(MoviesRepository $moviesRepository): Response
    {
        $movies = $moviesRepository->findAll();
        return $this->render('index.html.twig', [
            'movies' => $movies
        ]);
    }

    /**
     * @Route("/search-movie", name="search_movie")
     * @param Request $request
     * @param MovieDbManager $movieDb
     * @return Response
     */
    public function searchMovie(Request $request, MovieDbManager $movieDb): Response
    {
        $search = $request->get("search");
        $results = $movieDb->searchMovies($search);
        return $this->render('results.html.twig', [
            'results' => $results
        ]);
    }
}