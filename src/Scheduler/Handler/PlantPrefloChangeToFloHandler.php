<?php

namespace App\Scheduler\Handler;

use App\Entity\EnumStates;
use App\Scheduler\Message\PlantPrefloChangeToFlo;
use DateTimeImmutable;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use App\Service\PlantServiceInterface;
use App\Repository\PlantRepository;
use Doctrine\ORM\EntityManagerInterface;

#[AsMessageHandler]
class PlantPrefloChangeToFloHandler
{

    public function __construct(private readonly EntityManagerInterface $entityManager, private readonly PlantRepository $plantRepository, private readonly PlantServiceInterface $plantService){}

    public function __invoke(PlantPrefloChangeToFlo $message)
    {
        $plantsPreFlo = $this->plantRepository->findby(['state' => EnumStates::PREFLO]);
        $now = new DateTimeImmutable();
        foreach($plantsPreFlo as $plantPreFlo){
            $diff = $now->diff($plantPreFlo->getDateUpdated());
            if($diff->days >= 10){
                $plantPreFlo = $this->plantService->setDateFlo($plantPreFlo);
                $plantPreFlo->setState(EnumStates::FLO);
                $this->entityManager->persist($plantPreFlo);
                $this->entityManager->flush();
            }
        }
    }

}
