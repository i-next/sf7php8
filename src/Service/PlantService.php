<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\PlantRepository;

Class PlantService implements PlantServiceInterface
{

    public function __construct(private readonly PlantRepository $plantRepository)
    {
    }
    public function getCountByState(User $user): array
    {

        $plants = $this->plantRepository->countPlantsAllStates($user->getId());
        $arrayPlants = [];
        foreach($plants as $plant){
            $arrayPlants[$plant['state']->name] = $plant[1];

        }
        return $arrayPlants;
    }
}
