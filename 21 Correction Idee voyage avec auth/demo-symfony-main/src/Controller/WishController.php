<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Entity\User;
use App\Form\WishType;
use App\Form\WishType2;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/profile')]
class WishController extends AbstractController
{
    #[Route('/liste', name: 'app_wish_liste')]
    public function liste(WishRepository $repo): Response
    {
        $wishes = $repo->findBy(["isPublished" => true], ["dateCreated" => "DESC"]);
        return $this->render('wish/liste.html.twig', [
            'titre'=> 'Liste des wishes',
            'wishes' => $repo->findAll(),
        ]);
    }

    
    #[Route('/effacer/{id}', name: 'app_wish_effacer')]
    public function effacer(Wish $wish,EntityManagerInterface $em): Response
    {
        $this->addFlash('danger', 'Enlever :'.$wish->getTitle());
        $em->remove($wish);
        $em->flush();
       
        return $this->redirectToRoute('app_wish_liste');
    
    }

    #[Route('/editer/{id}', name: 'app_wish_editer')]
    public function editer(Wish $wish,EntityManagerInterface $em,Request $request): Response
    {
        $form = $this->createForm(WishType2::class, $wish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('primary', 'Modifier :'.$wish->getTitle());
            return $this->redirectToRoute('app_wish_liste');
        }
        return $this->render('wish/editer.html.twig', [
            'titre' => 'Editer',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/ajouter', name: 'app_wish_ajouter')]
    public function ajouter(EntityManagerInterface $em,Request $request): Response
    {
        $wish= new Wish();
        $wish->setAuthor($this->getUser()->getPseudo());
        $form = $this->createForm(WishType::class, $wish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($wish);
            $wish->setIsPublished(true);
            $wish->setDateCreated(new \DateTime());
            $em->flush();
            $this->addFlash('success', 'Ajouter :'.$wish->getTitle());
            return $this->redirectToRoute('app_wish_liste');
        }
        return $this->render('wish/editer.html.twig', [
            'titre' => 'Editer',
            'form' => $form->createView(),
        ]);
    }
}
