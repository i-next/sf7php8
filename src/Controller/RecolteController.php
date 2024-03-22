<?php

namespace App\Controller;

use App\Entity\Plant;
use App\Entity\Recolte;
use App\Form\RecolteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\RecolteRepository;

#[Route('/recolte')]
class RecolteController extends AbstractController
{
    #[Route('', name: 'app_recolte')]
    public function index(RecolteRepository $recolteRepository): Response
    {
        return $this->render('recolte/index.html.twig', [
            'recoltes'  => $recolteRepository->findBy(['userid' => $this->getUser()]),
            'nav'       => 'recoltes',
        ]);
    }

    #[Route('/new/{id}', name: 'app_recolte_add', methods: ['GET', 'POST'])]
    public function new(Plant $plant,Request $request, EntityManagerInterface $entityManager): Response
    {

        $recolte = new Recolte();
        $recolte->setPlant($plant);
        $recolte->setUserid($this->getUser());
        $recolte->setDateRecolte(new \DateTimeImmutable());
        $form = $this->createForm(RecolteType::class, $recolte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($recolte);
            $entityManager->flush();

            return $this->redirectToRoute('app_recolte', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recolte/new.html.twig', [
            'recolte' => $recolte,
            'form' => $form,
            'nav'       => 'recoltes',
        ]);
    }
}
