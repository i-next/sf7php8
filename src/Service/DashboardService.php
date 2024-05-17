<?php

namespace App\Service;

use App\Entity\EnumStates;
use App\Entity\User;
use App\Repository\BreederRepository;
use App\Repository\MySeedsRepository;
use App\Repository\PlantRepository;
use App\Repository\SeederRepository;
use App\Repository\SeedRepository;
use App\Repository\StrainRepository;
use App\Service\DashboardServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\SecurityBundle\Security;

class DashboardService implements DashboardServiceInterface
{
    public function __construct(
        private readonly BreederRepository $breederRepository,
        private readonly StrainRepository $strainRepository,
        private readonly PlantRepository $plantRepository,
        private readonly SeederRepository $seederRepository,
        private readonly SeedRepository $seedRepository,
        private readonly MySeedsRepository $mySeedsRepository,
        private readonly PlantServiceInterface $plantService,
        private readonly RequestStack $requestStack,
        private readonly Security $security,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }
    public function getDashboardData(): array
    {
        $user = $this->security->getUser();

        $data = [];
        $states = EnumStates::toArray();
        foreach($states as $key => $state){
            if(class_exists("App\\Entity\\" .$state)) {
                $user = $this->security->getUser();
                $repo = $this->entityManager->getRepository("App\\Entity\\" . $state);
                $count = $repo->countPlantsByState($user->getId());
                $data[$key] = $count;
            }
        }

        //$data['plants'] = $this->plantService->getCountByState() ?? 0;
        $data['plants'] = 0;
        $data['breeders'] = $this->breederRepository->countBreeders() ?? 0;
        $data['strains'] = $this->strainRepository->countStrains() ?? 0;
        $data['seed_count'] = $this->seedRepository->getCountSeed() ?? 0;
        $data['my_seeds_count'] = $this->mySeedsRepository->getCountSeed() ?? 0;
        $data['my_breeders_count'] = $this->mySeedsRepository->getCountBreeder();
        return $data;
    }
}
