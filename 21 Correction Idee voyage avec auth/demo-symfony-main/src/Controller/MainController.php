<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Repository\CategoryRepository;
use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function liste(CategoryRepository $repo): Response
    {
       // $wishes = $repo->findBy(["isPublished" => true], ["dateCreated" => "DESC"]);
        return $this->render('main/liste.html.twig', [
            'titre'=> 'Home',
            'categories' => $repo->findListCategoriesWithWishes(),
        ]);
    }
    #[Route('/detail/{id}', name: 'app_wish_detail')]
    public function detail(Wish $wish): Response
    {
        return $this->render('wish/detail.html.twig', [
            'titre' => $wish->getTitle(),
            'wish' => $wish
        ]);
    }

    #[Route('/about-us', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('main/about.html.twig', [
            'titre' => 'About Us',
        ]);
    }
   
}
