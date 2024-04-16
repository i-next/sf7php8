<?php

namespace App\Controller;

use App\Entity\Breeder;
use App\Repository\BreederRepository;
use App\Service\DatatablesServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Request;

#[Route('/breeder', name: 'app_breeder_')]
#[IsGranted('ROLE_USER')]
class BreederController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(BreederRepository $breederRepository, TranslatorInterface $translator, Request $request, EntityManagerInterface $entityManager): Response
    {
        return $this->render('breeder/index.html.twig', [
            'nav' => 'breeder',
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Breeder $breeder): Response
    {
        return $this->render('breeder/show.html.twig',[
            'breeder'   => $breeder,
            'nav'       => 'breeder',
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/del/{id}', name: 'del', methods: ['GET'])]
    public function del(Breeder $breeder,EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($breeder);
        $entityManager->flush();

        return $this->redirectToRoute('app_breeder_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/ajaxbreeders', name: 'ajax')]
    public function ajaxBreeders(Request $request, DatatablesServiceInterface $datatablesService): JsonResponse
    {
        $queryResult = $datatablesService->getData('Breeder',$request);
        $queryResult['admin'] = false;
        if (in_array('ROLE_ADMIN', $this->getUser()->getRoles(), true)) {
            $queryResult['admin'] = true;
        }
        return new JsonResponse($queryResult);
    }
}
