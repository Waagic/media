<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Entity\VideoGame;
use App\Repository\VideoGameRepository;
use App\Service\API\MovieDbManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/videogames")
 */
class VideoGamesController extends AbstractController
{
    /**
     * @Route("/", name="videogames_index", methods={"GET"})
     * @param VideoGameRepository $videoGameRepository
     * @return Response
     */
    public function index(VideoGameRepository $videoGameRepository): Response
    {
        return $this->render('games/index.html.twig', [
            'games' => $videoGameRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="videogames_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $videoGame = new VideoGame();
        $title = $request->request->get("title");
        $poster = $request->request->get("poster");
        $videoGame->setTitle($title);
        $videoGame->setPoster($poster);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($videoGame);
        $entityManager->flush();

        return $this->redirectToRoute('videogames_index');
    }

    /**
     * @Route("/{id}", name="videogames_show", methods={"GET"})
     * @param VideoGame $videoGame
     * @return Response
     */
    public function show(VideoGame $videoGame): Response
    {
        return $this->render('videogames/show.html.twig', [
            'videogame' => $videoGame,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="videogames_delete", methods={"DELETE"})
     * @param Request $request
     * @param VideoGame $videoGame
     * @return Response
     */
    public function delete(Request $request, VideoGame $videoGame): Response
    {
        if ($this->isCsrfTokenValid('delete'.$videoGame->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($videoGame);
            $entityManager->flush();
        }

        return $this->redirectToRoute('videogames_index');
    }
}
