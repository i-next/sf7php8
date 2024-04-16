<?php

namespace App\Controller;

use App\Entity\Seeder;
use App\Form\SeederType;
use App\Repository\SeederRepository;
use App\Entity\Breeder;
use App\Entity\Strain;
use App\Repository\BreederRepository;
use App\Service\DatatablesServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;


#[Route('/seeder',name: 'app_seeder_')]
#[IsGranted('ROLE_USER')]
class SeederController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, BreederRepository $breederRepository, HttpClientInterface $httpClient): Response
    {
        return $this->render('seeder/index.html.twig', [
            'breeders'   => $breederRepository->findBy([], ['name' => 'asc']),
            'nav'       => 'seeder',
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
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
            'seeder'    => $seeder,
            'form'      => $form,
            'nav'       => 'seeder'
        ]);
    }

    #[Route('/ajaxseeders', name: 'ajax')]
    public function ajaxSeeders(Request $request, DatatablesServiceInterface $datatablesService): JsonResponse
    {
        $queryResult = $datatablesService->getData('Breeder',$request);
        $queryResult['admin'] = false;
        if (in_array('ROLE_ADMIN', $this->getUser()->getRoles(), true)) {
            $queryResult['admin'] = true;
        }
        return new JsonResponse($queryResult);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Seeder $seeder): Response
    {
        return $this->render('seeder/show.html.twig', [
            'seeder'    => $seeder,
            'nav'       => 'seeder'
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Seeder $seeder, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SeederType::class, $seeder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_seeder_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('seeder/edit.html.twig', [
            'seeder'    => $seeder,
            'form'      => $form,
            'nav'       => 'seeder'
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Seeder $seeder, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seeder->getId(), $request->request->get('_token'))) {
            $entityManager->remove($seeder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_seeder_index', [], Response::HTTP_SEE_OTHER);
    }


}
