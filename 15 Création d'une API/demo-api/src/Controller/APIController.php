<?php

namespace App\Controller;

use App\Entity\Film;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class APIController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function home(){
        return $this->render('home.html.twig');
    }
           
    #[Route('/api/film', name: 'api_post_film', methods: ['POST'])]
    public function ajouter(Request $request,EntityManagerInterface $em,SerializerInterface $serializer): Response
    {
        // le body : $request->getContent()
        // permet de deserialiser et d'hydrater
        // setTitle
        // setAnnee
        // setWatched attention true != 'true'
        $film = $serializer->deserialize($request->getContent(), Film::class, 'json');
        $em->persist($film);
        $em->flush();
        return $this->json($film); // avec id = renseigner
    }

    #[Route('/api/film', name: 'api_get_film', methods: ['GET'])]
    public function afficher(FilmRepository $repo): Response
    {
        return $this->json($repo->findAll());
    }
    #[Route('/api/film/{id}', name: 'api_delete_film', methods: ['DELETE'])]
    public function enlever(Film $film,EntityManagerInterface $em): Response
    {
       
        $em->remove($film);
        $em->flush();
        return $this->json($tab["message"]="ok");
    }
}
