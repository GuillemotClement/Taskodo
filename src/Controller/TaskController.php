<?php

namespace App\Controller;

use App\Entity\Todo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TaskController extends AbstractController
{
    #[Route('/tasks', name: 'tasks')]
    public function index(EntityManagerInterface $em): Response
    {
        $todos = $em->getRepository(Todo::class)->findAll();
        // dd($todos);
        return $this->render('task/index.html.twig', [
            'todos' => $todos,
        ]);
    }

    // #[Route('/tasks/{id}', name: 'show')]
    // public function index(): Response {}

    // #[Route('/tasks', name: 'store')]
    // public function index(): Response {}

    // #[Route('/tasks/{id}', name: 'update')]
    // public function index(): Response {}

    // #[Route('/tasks/{id}', name: 'destroy')]
    // public function index(): Response {}
}
