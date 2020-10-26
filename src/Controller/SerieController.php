<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use App\Service\API\MovieDbManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/series")
 */
class SerieController extends AbstractController
{
    /**
     * @Route("/", name="series_index", methods={"GET"})
     * @param SerieRepository $serieRepository
     * @return Response
     */
    public function index(SerieRepository $serieRepository): Response
    {
        return $this->render('series/index.html.twig', [
            'series' => $serieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="series_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $serie = new Serie();
        $title = $request->request->get("title");
        $poster = $request->request->get("poster");
        $serie->setTitle($title);
        $serie->setPoster($poster);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($serie);
        $entityManager->flush();

        return $this->redirectToRoute('series_index');
    }

    /**
     * @Route("/{id}", name="series_show", methods={"GET"})
     * @param Serie $serie
     * @return Response
     */
    public function show(Serie $serie): Response
    {
        return $this->render('series/show.html.twig', [
            'serie' => $serie,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="series_delete", methods={"DELETE"})
     * @param Request $request
     * @param Serie $serie
     * @return Response
     */
    public function delete(Request $request, Serie $serie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$serie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($serie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('series_index');
    }
}
