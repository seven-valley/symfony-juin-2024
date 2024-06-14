<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Entity\Personne;
use App\Repository\EquipeRepository;
use App\Repository\PersonneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Role\Role;

class ApiController extends AbstractController
{
    #[Route('/api/personne', name: 'api_personne_post', methods: ['POST'])]
    public function ajouterPersonne(EquipeRepository $repoE ,Request $request,SerializerInterface $serializer,EntityManagerInterface $em): Response
    {
        // deserialiser
          // le body : $request->getContent()
           $obj = json_decode($request->getContent());
           $personne = new Personne();
           $personne->setNom($obj->nom);
           $personne->setPrenom($obj->prenom);
          
         // $personne = $serializer->deserialize($request->getContent(), Personne::class, 'json');
          $em->persist($personne);
          $em->flush();
          $equipe_id =$obj->equipe;
          $equipe = $repoE->find($equipe_id);
          $equipe->addPersonne($personne);
          $em->flush();  
        return $this->json($personne);
    }
    #[Route('/api/personne', name: 'api_personne_get', methods: ['GET'])]
    public function afficherPersonne(PersonneRepository $repo): Response
    {
       
       return $this->json($repo->findAll());
    }
    #[Route('/api/personne/{id}', name: 'api_personne_delete', methods: ['DELETE'])]
    public function enleverPersonne(Personne $p,EntityManagerInterface $em): Response
    {
        $em->remove($p);
        $em->flush();
       return $this->json($p);
    }


    #[Route('/api/equipe', name: 'api_equipe_post', methods: ['POST'])]
    public function ajouterEquipe(Request $request,SerializerInterface $serializer,EntityManagerInterface $em): Response
    {
          $equipe = $serializer->deserialize($request->getContent(), Equipe::class, 'json');
          $em->persist($equipe);
          $em->flush();

        return $this->json($equipe);
    }
    #[Route('/api/equipe', name: 'api_equipe_get', methods: ['GET'])]
    public function afficherEquipe(EquipeRepository $repo): Response
    {
       
       return $this->json($repo->findAll());
    }
    #[Route('/api/equipe/{id}', name: 'api_equipe_delete', methods: ['DELETE'])]
    public function enleverEquipe(Equipe $e,EntityManagerInterface $em): Response
    {
        $em->remove($e);
        $em->flush();
       return $this->json($e);
    }
}
