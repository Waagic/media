<?php

// src/Controller/HomeController.php
namespace App\Controller;

use App\Repository\MoviesRepository;
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
            'movies' => $movies,
        ]);
    }
}