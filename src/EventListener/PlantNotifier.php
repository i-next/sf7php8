<?php

namespace App\EventListener;

use App\Entity\Plant;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use App\Entity\PlantHistory;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PreRemoveEventArgs;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::postPersist, method: 'postPersist', entity: Plant::class)]
#[AsEntityListener(event: Events::postUpdate, method: 'postUpdate', entity: Plant::class)]
#[AsEntityListener(event: Events::preRemove, method: 'preRemove', entity: Plant::class)]
readonly class PlantNotifier
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function postPersist(Plant $plant, PostPersistEventArgs $postPersistEventArgs): void
    {
        $this->setPlantHistory($plant);
    }
    public function postUpdate(Plant $plant, PostUpdateEventArgs $postUpdateEventArgs): void
    {
        $this->setPlantHistory($plant);
    }

    public function preRemove(Plant $plant, PreRemoveEventArgs $preRemoveEventArgs): void
    {
        $plantHistories = $plant->getPlantHistories();
        foreach($plantHistories as $plantHistory) {
            $this->entityManager->remove($plantHistory);
            $this->entityManager->flush();
        }
    }

    private function setPlantHistory(Plant $plant): void
    {
        $plantHistory = new PlantHistory();
        $plantHistory->setPlantId($plant);
        $plantHistory->setState($plant->getState());
        $this->entityManager->persist($plantHistory);
        $this->entityManager->flush();
    }

}
