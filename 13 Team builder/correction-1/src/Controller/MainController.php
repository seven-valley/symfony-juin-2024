<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Entity\Personne;
use App\Form\EquipeType;
use App\Form\PersonneType;
use App\Repository\EquipeRepository;
use App\Repository\PersonneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(EquipeRepository $equipeRepository, PersonneRepository $personneRepository): Response
    {
        $personne = new Personne();
        $formPersonne = $this->createForm(PersonneType::class, $personne, 
        ['action' => $this->generateUrl('ajouter_personne')]);

        $equipe = new Equipe();
        $formEquipe = $this->createForm(EquipeType::class, $equipe,
        ['action' => $this->generateUrl('ajouter_equipe')]);
       

        return $this->render('home.html.twig', [
            'formEquipe'=> $formEquipe,
            'formPersonne'=> $formPersonne,
            'equipes' => $equipeRepository->findAll(),
            'personnes' => $personneRepository->findAll(),
        ]);
    }
    #[Route('/ajouter-equipe', name: 'ajouter_equipe')]
    public function ajouterEquipe(EntityManagerInterface $em, Request $request): Response
    {
        $equipe = new Equipe();
        $formEquipe = $this->createForm(EquipeType::class, $equipe);
        $formEquipe->handleRequest($request);

        if ($formEquipe->isSubmitted() && $formEquipe->isValid()) {
            $em->persist($equipe);
            $em->flush();

            return $this->redirectToRoute('app_main');
        }
        return $this->redirectToRoute('app_main');
    }

    #[Route('/ajouter-personne', name: 'ajouter_personne')]
    public function ajouterPersonne(EntityManagerInterface $em, Request $request): Response
    {
        $personne = new Personne();
        $formPersonne = $this->createForm(PersonneType::class, $personne);
        $formPersonne->handleRequest($request);
    

        if ($formPersonne->isSubmitted() && $formPersonne->isValid()) {
            // recupérer equipe
            $equipe = $formPersonne->get('equipe')->getData();
            if ($equipe){
                $personne->addEquipe($equipe);
            }
                
            $em->persist($personne);
            $em->flush();
           return $this->redirectToRoute('app_main');
        }
        return $this->redirectToRoute('app_main');
    }
}
