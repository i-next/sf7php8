<?php

namespace App\EventListener;

use App\Entity\MySeeds;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Bundle\SecurityBundle\Security;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: MySeeds::class)]
readonly class MySeedsNotifier
{


    public function __construct(private EntityManagerInterface $entityManager, private readonly Security $security)
    {
    }

    public function prePersist(MySeeds $mySeeds, PrePersistEventArgs $postPersistEventArgs): void
    {
        $mySeeds->setUserid($this->security->getUser());
    }


}
