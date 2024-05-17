<?php

namespace App\Controller;

use App\Entity\Plant;
use App\Repository\PlantHistoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/planthistory')]
class PlantHistoryController extends AbstractController
{
    #[Route('', name: 'app_plant_history_list')]
    public function index(PlantHistoryRepository $plantHistoryRepository): Response
    {
        $plantHistories = $plantHistoryRepository->findAll();
        return $this->render('plant_history/list.html.twig', [
            'planthistories' => $plantHistories,
            'nav' => 'plant',
        ]);
    }

    #[Route('/{id}', name: 'app_plant_history')]
    public function getOne(Plant $plant, PlantHistoryRepository $plantHistoryRepository): Response
    {
        $plantHistories = $plantHistoryRepository->findBy(['plant_id' => $plant], ['date' => 'DESC']);
        return $this->render('plant_history/index.html.twig', [
            'planthistories' => $plantHistories,
        ]);
    }
}
