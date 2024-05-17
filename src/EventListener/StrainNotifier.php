<?php

namespace App\EventListener;

use App\Entity\Strain;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Bundle\SecurityBundle\Security;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Strain::class)]
readonly class StrainNotifier
{
    public function __construct(private EntityManagerInterface $entityManager, private readonly Security $security)
    {
    }

    public function prePersist(Strain $strain, PrePersistEventArgs $postPersistEventArgs): void
    {
        $strain->setUserid($this->security->getUser());
    }
}
