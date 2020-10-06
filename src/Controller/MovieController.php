<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MoviesType;
use App\Repository\MovieRepository;
use App\Service\API\MovieDbManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/movies")
 */
class MovieController extends AbstractController
{
    /**
     * @Route("/", name="movies_index", methods={"GET"})
     * @param MovieRepository $movieRepository
     * @return Response
     */
    public function index(MovieRepository $movieRepository): Response
    {
        return $this->render('movies/index.html.twig', [
            'movies' => $movieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="movies_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $movie = new Movie();
        $title = $request->request->get("title");
        $poster = $request->request->get("poster");
        $movie->setTitle($title);
        $movie->setPoster("https://image.tmdb.org/t/p/w500/" . $poster);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($movie);
        $entityManager->flush();

        return $this->redirectToRoute('movies_index');
    }

    /**
     * @Route("/{id}", name="movies_show", methods={"GET"})
     * @param Movie $movie
     * @return Response
     */
    public function show(Movie $movie): Response
    {
        return $this->render('movies/show.html.twig', [
            'movie' => $movie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="movies_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Movie $movie
     * @return Response
     */
    public function edit(Request $request, Movie $movie): Response
    {
        $form = $this->createForm(MoviesType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('movies_index');
        }

        return $this->render('movies/edit.html.twig', [
            'movie' => $movie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="movies_delete", methods={"DELETE"})
     * @param Request $request
     * @param Movie $movie
     * @return Response
     */
    public function delete(Request $request, Movie $movie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$movie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($movie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('movies_index');
    }
}
