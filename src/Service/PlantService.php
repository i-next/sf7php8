<?php

namespace App\Service;

use App\Entity\EnumStates;
use App\Entity\Plant;
use App\Entity\User;
use App\Repository\PlantRepository;
use DateInterval;
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

    /**
     * @throws \Exception
     */
    public function setDateFlo(Plant $plant): Plant
    {
        $now = new \DateTimeImmutable();
        $durationDays = $plant->getSeedid()->getDuration() * 7;
        $dateFlo = $now->add(new DateInterval('P'.$durationDays.'D'));
        $plant->setDateFlo($dateFlo);
        $plant->setState(EnumStates::FLO);
        return $plant;
    }
}
