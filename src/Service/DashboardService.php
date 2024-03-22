<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\PlantRepository;
use App\Repository\SeederRepository;
use App\Repository\SeedRepository;
Use App\Service\PlantServiceInterface;
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
    )
    {}
    public function getDashboardData(): array
    {
        $user = $this->security->getUser();
        $this->requestStack->getSession()->getFlashBag()->add('notice','test notice');
        $this->requestStack->getSession()->save();

        $data = [];
        $data['plants'] = $this->plantService->getCountByState($user);
        $data['seeders'] = $this->seederRepository->count();
        $data['seed_type'] = $this->seedRepository->count(['userid' => $user->getId()]);
        $data['seed_count'] = $this->seedRepository->getCountSeed($user->getId());
        return $data;
    }
}
