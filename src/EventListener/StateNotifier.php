<?php

namespace App\EventListener;

use App\Entity\Blooms;
use App\Entity\Germination;
use App\Entity\Growths;
use App\Entity\Harvests;
use App\Entity\Preblooms;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\PrePersist;
use Symfony\Bundle\SecurityBundle\Security;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Germination::class)]
#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Growths::class)]
#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Preblooms::class)]
#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Blooms::class)]
#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Harvests::class)]
readonly class StateNotifier
{
    public function __construct(private EntityManagerInterface $entityManager, private readonly Security $security)
    {
    }

    public function prePersist($entity, PrePersistEventArgs $prePersistEventArgs ): void
    {
        if(is_null($entity->getDateCreated())){
            $entity->setDateCreated(new \DateTimeImmutable());
        }
        $entity->setDateUpdated(new \DateTimeImmutable());
        $entity->setUserid($this->security->getUser());
    }

}
