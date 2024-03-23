<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\PlantRepository;
use App\Repository\SeederRepository;
use App\Repository\SeedRepository;
use App\Service\PlantServiceInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\SecurityBundle\Security;

class DashboardService
{
    public function __construct(
        private readonly PlantRepository $plantRepository,
        private readonly SeederRepository $seederRepository,
        private readonly SeedRepository $seedRepository,
        private readonly PlantServiceInterface $plantService,
        private readonly RequestStack $requestStack,
        private readonly Security $security,
    ) {
    }
    public function getDashboardData(): array
    {
        $user = $this->security->getUser();

        $data = [];
        $data['plants'] = $this->plantService->getCountByState();
        $data['seeders'] = $this->seederRepository->count();
        $data['seed_type'] = $this->seedRepository->count(['userid' => $user->getId()]);
        $data['seed_count'] = $this->seedRepository->getCountSeed();
        return $data;
    }
}
