<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setRoles(["ROLE_USER"]);
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_home');
        }

        return $this->render('admin/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    #[Route('/user/liste', name: 'app_user_liste')]
    public function liste(UserRepository $repo): Response
    {
           return $this->render('admin/liste-user.html.twig', [
            'titre'=> 'Liste des utilisateurs',
            'users' => $repo->findAll(),
        ]);
    }

    #[Route('/user/liste2', name: 'app_user_liste_2')]
    public function liste2(UserRepository $repo): Response
    {
           return $this->json($repo->findAll());
    }
}
