<?php

namespace App\EventListener;

use App\Entity\MyPlants;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreRemoveEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\PrePersist;
use Symfony\Bundle\SecurityBundle\Security;

#[AsEntityListener(event: Events::preRemove, method: 'preRemove', entity: MyPlants::class)]
#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: MyPlants::class)]
readonly class MyPlantsNotifier
{
    public function __construct(private readonly EntityManagerInterface $entityManager,private readonly Security $security)
    {
    }

    public function preRemove(MyPlants $myPlants, PreRemoveEventArgs $postPersistEventArgs ): void
    {

            $myseed = $myPlants->getMySeeds();
            $myseed->setQuantity($myseed->getQuantity()-1);
            $this->entityManager->persist($myseed);
            $this->entityManager->flush();

    }

    public function prePersist(MyPlants $myPlants, PrePersistEventArgs $prePersistEventArgs): void
    {
        if(is_null($myPlants->getDateCreated())){
            $myPlants->setDateCreated(new \DateTimeImmutable());
        }
        $myPlants->setDateUpdated(new \DateTimeImmutable());
        $myPlants->setUserid($this->security->getUser());
    }

}
