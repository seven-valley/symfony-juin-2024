<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Form\WishModifierType;
use App\Repository\WishRepository;
use DateTime;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// je prefixe toutes les routes avec admin/
#[Route('/admin')]
class BackWishController extends AbstractController
{
    #[Route('/wish/liste', name: 'admin_wish_liste')]
    public function liste(WishRepository $repo): Response
    {
        $wishes = $repo->findBy(["isPublished" => true], ["createdAt" => "DESC"]);
       //dd($wishes);
        return $this->render('admin/wish/liste.html.twig', [
            'wishes' =>$wishes,
        ]);
    }
    #[Route('/wish-ajouter', name: 'admin_wish_ajouter')]
    public function ajouter(EntityManagerInterface $em,Request $request): Response
    {
       // ajouter
       $wish = new Wish();
       $formWish = $this->createForm(WishType::class,$wish);
       // handleRequest :
       // $wish->setTitle = ...
       $formWish->handleRequest($request);
       
       if ($formWish->isSubmitted() && $formWish->isValid()){
        
        $titre = $formWish->get('title')->getData();
       
        $wish->setTitle(strtoupper($titre));
        $wish->setPublished(true);
        $wish->setCreatedAt(new DateTime());
        $em->persist($wish);
        $em->flush();
        // ajouter flash message
        $this->addFlash('success','Nouveau :'.$titre);
        return $this->redirectToRoute("admin_wish_liste");
        
       }

       return $this->render('admin/wish/ajouter.html.twig', [
        'formWish' => $formWish,
    ]);
      
    }
    #[Route('/wish-edit/{id}', name: 'admin_wish_modifier')]
    public function modifier(Wish $wish,EntityManagerInterface $em,Request $request): Response
    {
          // ajouter
      // $wish = new Wish();
       $formWish = $this->createForm(WishModifierType::class,$wish);
       // handleRequest :
       // $wish->setTitle = ...
       $formWish->handleRequest($request);
       
       if ($formWish->isSubmitted() && $formWish->isValid()){
        
        $titre = $formWish->get('title')->getData();
       
        $wish->setTitle(strtoupper($titre));
        //$wish->setPublished(true);
        //$wish->setCreatedAt(new DateTime());
      //  $em->persist($wish);
        $em->flush();
        // ajouter flash message
        $this->addFlash('primary','Nouveau :'.$titre);
        return $this->redirectToRoute("admin_wish_liste");
        
       }

       return $this->render('admin/wish/ajouter.html.twig', [
        'formWish' => $formWish,
    ]);
    }
}
