<?php

namespace App\Controller;

// auto completion 

use App\Entity\Film;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FrontWishController extends AbstractController
{
   /*
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
    public function ajouter(EntityManagerInterface $em)
    {
        $film = new Film();
        $film->setTitle('SAW');
        $film->setAnnee('2006');
        $film->setRealisateur('toto');
        $film->setValid(true);
        dump($film);
        $em->persist($film);
        $em->flush();

        dd($film);
        // return $this->render('main/contact.html.twig', [
        //     'titre' => 'Contact'

        // ]);
    }

    #[Route('/contact', name: 'main_contact')]
    public function contact(): Response
    {
        return $this->render('main/contact.html.twig', [
            'titre' => 'Contact'

        ]);
    }
    */
}
