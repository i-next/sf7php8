<?php

namespace App\Controller;

use App\Entity\Seeder;
use App\Form\SeederType;
use App\Repository\SeederRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/seeder')]
class SeederController extends AbstractController
{
    #[Route('/', name: 'app_seeder_index', methods: ['GET'])]
    public function index(SeederRepository $seederRepository): Response
    {
        return $this->render('seeder/index.html.twig', [
            'seeders' => $seederRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_seeder_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $seeder = new Seeder();
        $form = $this->createForm(SeederType::class, $seeder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($seeder);
            $entityManager->flush();

            return $this->redirectToRoute('app_seeder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('seeder/new.html.twig', [
            'seeder' => $seeder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_seeder_show', methods: ['GET'])]
    public function show(Seeder $seeder): Response
    {
        return $this->render('seeder/show.html.twig', [
            'seeder' => $seeder,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_seeder_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Seeder $seeder, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SeederType::class, $seeder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_seeder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('seeder/edit.html.twig', [
            'seeder' => $seeder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_seeder_delete', methods: ['POST'])]
    public function delete(Request $request, Seeder $seeder, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seeder->getId(), $request->request->get('_token'))) {
            $entityManager->remove($seeder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_seeder_index', [], Response::HTTP_SEE_OTHER);
    }
}
