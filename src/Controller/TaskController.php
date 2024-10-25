<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TaskController extends AbstractController
{
    #[Route('/tasks', name: 'tasks_index')]
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

    #[Route('/tasks/store', name: 'task_store')]
    public function store(Request $req, EntityManagerInterface $em): Response
    {
        $task = new Todo();

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setCreatedAt(new \DateTimeImmutable());
            // si edition, alors on passe le dateTime lors de la soumission de l'edition
            // A modifier quand authentification sera mis en place
            $task->setAuthorId(1);
            $em->persist($task);
            $em->flush();
            // ajouter un message flash
            return $this->redirectToRoute('tasks_index');
        }

        return $this->render('task/store.html.twig', [
            'form' => $form,
        ]);
    }

    // #[Route('/tasks/{id}', name: 'update')]
    // public function index(): Response {}

    // #[Route('/tasks/{id}', name: 'destroy')]
    // public function index(): Response {}
}
