<?php

namespace App\Controller;

// auto completion 

use App\Entity\Film;
use App\Form\FilmType;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_home')]
    public function home(FilmRepository $repo): Response
    {

        $films = $repo->findAll();
        return $this->render('main/home.html.twig', [
            'titre' => 'Home',
            'films' => $films,
        ]);
    }
    #[Route('/film/{id}', name: 'main_film')]
    public function film(Film $film): Response
    {
        //dd($film); 

        return $this->render('main/film.html.twig', [
            'titre' => 'Details film :',
            'film' => $film,
        ]);
    }
    #[Route('/about', name: 'main_about')]
    public function about(): Response
    {
        return $this->render('main/about.html.twig', [
            'titre' => 'About us'

        ]);
    }
    #[Route('/ajouter', name: 'main_ajouter')]
    public function ajouter(EntityManagerInterface $em,Request $request)
    {
        
        $film = new Film();
        $filmForm = $this->createForm(FilmType::class,$film);
        $filmForm->handleRequest($request);
        // si form SUBMIT
        if ($filmForm->isSubmitted() && $filmForm->isValid()){
            $film->setValid(true);
            $em->persist($film);
            $em->flush();
            return $this->redirectToRoute("main_home");
        }
        return $this->render('main/ajouter.html.twig', [
            'titre' => 'Ajouter',
            'filmForm'=> $filmForm->createView(),
        ]);
    }

    #[Route('/contact', name: 'main_contact')]
    public function contact(): Response
    {
        return $this->render('main/contact.html.twig', [
            'titre' => 'Contact'

        ]);
    }
}
