<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use App\Form\RegisterUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(): Response
    {
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }

    #[Route('/register', name: 'register')]
    public function registerUser(Request $req, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher, ?User $user  = null): Response
    {
        //si user n'existe pas, alors création sinon c'est une édition
        if (!$user) {
            $user = new User();
            $user->setCreatedAt(new \DateTime());
        } else {
            $user->setUpdateAt(new \DateTime());
        }

        $form = $this->createForm(RegisterUserType::class, $user);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hash du mot de passe
            if ($user->getPassword()) {
                $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
                $user->setPassword($hashedPassword);
            }

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('homepage_index');
        };

        return $this->render('profil/registerUser.html.twig', [
            'form' => $form
        ]);
    }
}
