<?php

namespace App\Controller;

use App\Entity\Breeder;
use App\Repository\BreederRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/breeder')]
#[IsGranted('ROLE_USER')]
class BreederController extends AbstractController
{
    #[Route('/', name: 'app_breeder_index')]
    public function index(BreederRepository $breederRepository,EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $user->setRoles(['ROLE_ADMIN']);
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->render('breeder/index.html.twig', [
            'breeders' => $breederRepository->findBy([]),
            'nav' => 'breeder',
        ]);
    }

    #[Route('/{id}', name: 'app_breeder_show', methods: ['GET'])]
    public function show(Breeder $breeder): Response
    {
        return $this->render('breeder/show.html.twig',[
            'breeder'   => $breeder,
            'nav'       => 'breeder',
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/del/{id}', name: 'app_breeder_del', methods: ['GET'])]
    public function del(Breeder $breeder,EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($breeder);
        $entityManager->flush();

        return $this->redirectToRoute('app_breeder_index', [], Response::HTTP_SEE_OTHER);
    }

}
