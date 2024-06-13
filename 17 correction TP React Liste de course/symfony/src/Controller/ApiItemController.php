<?php

namespace App\Controller;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiItemController extends AbstractController
{
    
           
    #[Route('/api/item', name: 'api_post_item', methods: ['POST'])]
    public function ajouter(Request $request,EntityManagerInterface $em,SerializerInterface $serializer): Response
    {      
        $item = $serializer->deserialize($request->getContent(), Item::class, 'json');
        $item->setBuy(false);
        $em->persist($item);
        $em->flush();
        return $this->json($item); // avec id = renseigner
    }

    #[Route('/api/item', name: 'api_get_item', methods: ['GET'])]
    public function afficher(ItemRepository $repo): Response
    {
        return $this->json($repo->findAll());
    }

    #[Route('/api/item/{id}', name: 'api_patch_film', methods: ['PATCH'])]
    public function modifier(Item $item,EntityManagerInterface $em): Response
    {
        $item->setBuy(!$item->isBuy());
        $em->flush();
        return $this->json($item);
        
    }

    #[Route('/api/item/{id}', name: 'api_delete_film', methods: ['DELETE'])]
    public function enlever(Item $item,EntityManagerInterface $em): Response
    {
        $em->remove($item);
        $em->flush();
        return $this->json($item);
    }


        
}
