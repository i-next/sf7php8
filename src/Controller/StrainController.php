<?php

namespace App\Controller;

use App\Repository\StrainRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/strain')]
class StrainController extends AbstractController
{
    #[Route('/', name: 'app_strain_index')]
    public function index(StrainRepository $strainRepository): Response
    {
        return $this->render('strain/index.html.twig', [
            'controller_name'   => 'StrainController',
            'strains'           => $strainRepository->findAll(),
            'nav'               => 'strain'
        ]);
    }
}
