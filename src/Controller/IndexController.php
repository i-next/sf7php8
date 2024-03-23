<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\DashboardService;
use App\Entity\EnumStates;

#[IsGranted('ROLE_USER')]
class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(DashboardService $dashboardService): Response
    {
        $data = null;
        if ($this->getUser()) {
            $data = $dashboardService->getDashboardData();
        }
        return $this->render('index.html.twig', [
            'data_dashboard'    => $data,
            'nav'               => 'dashboard'
        ]);
    }

    #[Route('/header/{nav}', name: 'app_header', methods: ['GET'])]
    public function getHeader(string $nav): Response
    {
        return $this->render('blocks\header.html.twig', [
            'states'    => EnumStates::cases(),
            'nav'       => $nav
        ]);

    }
}
