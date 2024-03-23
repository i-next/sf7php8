<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\PlantRepository;
use Symfony\Bundle\SecurityBundle\Security;

class PlantService implements PlantServiceInterface
{
    public function __construct(private readonly PlantRepository $plantRepository, private readonly Security $security)
    {
    }
    public function getCountByState(): array
    {

        $plants = $this->plantRepository->countPlantsAllStates($this->security->getUser()->getId());
        $arrayPlants = [];
        foreach($plants as $plant) {
            $arrayPlants[$plant['state']->name] = $plant[1];

        }
        return $arrayPlants;
    }
}
