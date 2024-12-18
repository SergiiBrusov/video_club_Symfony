<?php

namespace App\Controller;

use App\Entity\MoviesFull;
use App\Form\MoviesFullType;
use App\Repository\MoviesFullRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;




#[Route('/movies/full')]
final class MoviesFullController extends AbstractController
{
    // nouvelle route et methode perso
    #[Route('/searchfilm', name: 'searchfilm', methods: ['GET'])]
    public function searchFilm(MoviesFullRepository $moviesFullRepository)
    {
        if (isset($_GET['champ']) && isset($_GET['value']) && isset($_GET["limit"])) {


            $champ = $_GET['champ'];
            $value = $_GET['value'];
            $limit = $_GET['limit'];


            //faire une recherche
            $result = $moviesFullRepository->searchBy($champ, $value, $limit);
            // dd($result);
            $resultArray = [];
            foreach ($result as $key => $value) {
                array_push($resultArray, [
                    "getId" => $value->getId(),
                    "title" => $value->getTitle(),
                    "casting" => $value->getCasting(),
                    "directors" => $value->getDirectors(),
                ]);
            }
            // pour retourner un format json depuis symfony on utilise la class JsonResponse
            return new JsonResponse($resultArray);
        } else {
            return $this->redirect('/');
        }
        //return json
    }



    #[Route(name: 'app_movies_full_index', methods: ['GET'])]
    public function index(MoviesFullRepository $moviesFullRepository): Response
    {
        return $this->render('movies_full/index.html.twig', [
            'movies_fulls' => $moviesFullRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_movies_full_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $moviesFull = new MoviesFull();
        $form = $this->createForm(MoviesFullType::class, $moviesFull);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($moviesFull);
            $entityManager->flush();

            return $this->redirectToRoute('app_movies_full_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('movies_full/new.html.twig', [
            'movies_full' => $moviesFull,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_movies_full_show', methods: ['GET'])]
    public function show(MoviesFull $moviesFull): Response
    {
        return $this->render('movies_full/show.html.twig', [
            'movies_full' => $moviesFull,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_movies_full_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MoviesFull $moviesFull, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MoviesFullType::class, $moviesFull);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_movies_full_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('movies_full/edit.html.twig', [
            'movies_full' => $moviesFull,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_movies_full_delete', methods: ['POST'])]
    public function delete(Request $request, MoviesFull $moviesFull, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $moviesFull->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($moviesFull);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_movies_full_index', [], Response::HTTP_SEE_OTHER);
    }
}
