<?php

namespace App\Controller;

use App\Repository\StrainRepository;
use App\Service\AutoCompleteServiceInterface;
use App\Service\DatatablesServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/strain', name: 'app_strain_')]
class StrainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(StrainRepository $strainRepository): Response
    {
        return $this->render('strain/index.html.twig', [
            'controller_name'   => 'StrainController',
            'strains'           => $strainRepository->findAll(),
            'nav'               => 'strain'
        ]);
    }

    #[Route('/ajaxbreederstrains', name: 'ajaxbreederstrains')]
    public function ajaxBreederStrains(Request $request, DatatablesServiceInterface $datatablesService,StrainRepository $strainRepository): JsonResponse
    {
        $queryResult = $datatablesService->getData('Strain',$request);
        $queryResult['admin'] = false;
        if (in_array('ROLE_ADMIN', $this->getUser()->getRoles(), true)) {
            $queryResult['admin'] = true;
        }
        return new JsonResponse($queryResult);
    }

    #[Route('/autocompletestrain', name: 'autocomplestrain')]
    public function autoCompleteStrains(Request $request, AutoCompleteServiceInterface $autoCompleteService): JsonResponse
    {
        return new JsonResponse($autoCompleteService->getStrainsQuery($request->query->all()));
    }
}
