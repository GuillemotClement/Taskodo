<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use App\Form\RegisterUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    public function registerUser(Request $req, EntityManagerInterface $em): Response
    {
        $user = new User();

        $form = $this->createForm(RegisterUserType::class, $user);

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setCreatedAt(new \DateTime());
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('homepage_index');
        };

        return $this->render('profil/registerUser.html.twig', [
            'form' => $form
        ]);
    }
}


// #[Route('/tasks/store', name: 'task_store')]
// public function store(Request $req, EntityManagerInterface $em): Response
// {
//     $task = new Todo();

//     $form = $this->createForm(TaskType::class, $task);

//     $form->handleRequest($req);

//     if ($form->isSubmitted() && $form->isValid()) {
//         $task->setCreatedAt(new \DateTimeImmutable());
//         // si edition, alors on passe le dateTime lors de la soumission de l'edition
//         // A modifier quand authentification sera mis en place
//         $task->setAuthorId(1);
//         $em->persist($task);
//         $em->flush();
//         // ajouter un message flash
//         return $this->redirectToRoute('tasks_index');
//     }

//     return $this->render('task/store.html.twig', [
//         'form' => $form,
//     ]);
// }