<?php

namespace App\Service;

use App\Entity\MySeeds;
use App\Entity\Strain;
use App\Entity\Breeder;
use App\Repository\MySeedsRepository;
use App\Service\MySeedsServiceInterface;
use App\Repository\BreederRepository;
use Doctrine\ORM\EntityManagerInterface;

class MySeedsService implements MySeedsServiceInterface
{
    public function __construct(private readonly BreederRepository $breederRepository, private readonly EntityManagerInterface $entityManager, private readonly MySeedsRepository $mySeedsRepository)
    {
    }

    public function create(array $data, MySeeds $mySeeds): MySeeds|bool
    {
        if($mySeeds->getStrain() instanceof Strain) {
            return $mySeeds;
        }
        if($data['strain'] === '') {
            return false;
        }
        $dataNewStrain = $data['newstrain'];
        $strain = new Strain();
        $strain->setName(ucwords($data['strain']));
        $strain->setNameId(str_replace(' ', '_', ucwords($data['strain'])));
        if(array_key_exists('description', $dataNewStrain)) {
            $strain->setDescription($dataNewStrain['description']);
        } else {
            $strain->setDescriptionen($dataNewStrain['descriptionen']);
        }
        $strain->setAuto(false);
        if(array_key_exists('auto', $dataNewStrain)) {
            $strain->setAuto(true);
        }
        $strain->setUrlPhoto($dataNewStrain['url_photo']);
        $strain->setDuration((int) $dataNewStrain['duration']);
        $strain->setType($dataNewStrain['type']);

        if(is_numeric($dataNewStrain['breeder'])) {
            $breeder = $this->breederRepository->find((int) $dataNewStrain['breeder']);
            $breeder->setQuantity($breeder->getQuantity() + 1);
        } else {
            if($dataNewStrain['breeder'] === '') {
                return false;
            }
            $breeder = new Breeder();
            $breeder->setQuantity(1);
            $breeder->setName($dataNewStrain['breeder']);
            $breeder->setNameId(str_replace(' ', '_', $dataNewStrain['breeder']));
            $breeder->setUrlPhoto($dataNewStrain['newbreeder']['url_photo']);
            $this->entityManager->persist($breeder);
        }
        $strain->setBreeder($breeder);
        $this->entityManager->persist($strain);
        $mySeeds->setStrain($strain);
        $this->entityManager->flush();
        return $mySeeds;
    }

    public function changeqty(array $data): int
    {
        $myseed = $this->mySeedsRepository->find($data['id']);

            $myseed->setQuantity($data['val']);

        $this->entityManager->persist($myseed);
        $this->entityManager->flush();
        return $myseed->getQuantity();
    }

    public function changecomment(array $data): string
    {
        $myseed = $this->mySeedsRepository->find($data['id']);

        $myseed->setcomment($data['val']);

        $this->entityManager->persist($myseed);
        $this->entityManager->flush();
        return $myseed->getComment();
    }
}
