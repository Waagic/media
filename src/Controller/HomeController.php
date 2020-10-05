<?php

// src/Controller/HomeController.php
namespace App\Controller;

use App\Repository\MoviesRepository;
use App\Service\API\MovieDbManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/search-movie={search}", name="search_movie")
     * @param string $search
     * @return Response
     */
    public function searchMovie(string $search): Response
    {
        $movieDb = new MovieDbManager();
        $results = $movieDb->searchMovies($search);
        return $this->render('index.html.twig', [
            'results' => $results
        ]);
    }
}