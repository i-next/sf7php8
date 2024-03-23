<?php

namespace App\Controller;

use App\Entity\EnumStates;
use App\Entity\Plant;
use App\Entity\Seed;
use App\Form\SeedType;
use App\Repository\SeedRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/seed')]
class SeedController extends AbstractController
{
    #[Route('', name: 'app_seed_index', methods: ['GET'])]
    public function index(SeedRepository $seedRepository): Response
    {
        return $this->render('seed/index.html.twig', [
            'seeds' => $seedRepository->findby(['userid' => $this->getUser()], ['name' => 'asc']),
            'nav'       => 'seed'
        ]);
    }

    #[Route('/new', name: 'app_seed_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $seed = new Seed();
        $form = $this->createForm(SeedType::class, $seed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $seed->setUserid($this->getUser());
            $entityManager->persist($seed);
            $entityManager->flush();

            return $this->redirectToRoute('app_seed_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('seed/new.html.twig', [
            'seed' => $seed,
            'form' => $form,
            'nav'  => 'seed'
        ]);
    }

    #[Route('/{id}', name: 'app_seed_show', methods: ['GET'])]
    public function show(Seed $seed): Response
    {
        return $this->render('seed/show.html.twig', [
            'seed' => $seed,
            'nav'  => 'seed'
        ]);
    }

    #[Route('/{id}/edit', name: 'app_seed_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Seed $seed, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SeedType::class, $seed);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_seed_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('seed/edit.html.twig', [
            'seed' => $seed,
            'form' => $form,
            'nav'  => 'seed'
        ]);
    }

    #[Route('/{id}', name: 'app_seed_delete', methods: ['POST'])]
    public function delete(Request $request, Seed $seed, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seed->getId(), $request->request->get('_token'))) {
            $entityManager->remove($seed);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_seed_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/change/{id}', name: 'app_seed_change')]
    public function change(Seed $seed, EntityManagerInterface $entityManager): Response
    {
        if($seed instanceof Seed) {
            $seed->setQuantity($seed->getQuantity() - 1);
            $entityManager->persist($seed);
            $plant = new Plant();
            $plant->setState(EnumStates::GERM);
            $plant->setUserid($this->getUser());
            $plant->setSeedid($seed);
            $plant->setDateCreated(new \DateTimeImmutable());
            $entityManager->persist($plant);
            $entityManager->flush();
            return  $this->redirectToRoute('app_plant_list', ['slug' => EnumStates::GERM->value], Response::HTTP_SEE_OTHER);
        }
        return $this->redirectToRoute('app_seed_index', [], Response::HTTP_SEE_OTHER);
    }
}
