<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_home')]
    public function home(): Response
    {
        $personnes =[
            0 => ["prenom"=>"Brad","nom"=>"PITT"],
            1 => ["prenom"=>"Angelina","nom"=>"JOLIE"],
            2 => ["prenom"=>"Tom","nom"=>"CRUISE"],
        ];
        return $this->render('main/home.html.twig', [
            'titre' => 'Home',
            'personnes'=> $personnes,
        ]);
    }
    #[Route('/about', name: 'main_about')]
    public function about(): Response
    {
        return $this->render('main/about.html.twig', [
            'titre' => 'About us'
            
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
