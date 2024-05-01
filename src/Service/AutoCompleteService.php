<?php

namespace App\Service;

use App\Service\AutoCompleteServiceInterface;
use App\Repository\StrainRepository;
use Doctrine\ORM\EntityManagerInterface;
class AutoCompleteService implements AutoCompleteServiceInterface
{

    public function __construct(private readonly StrainRepository $strainRepository, private readonly EntityManagerInterface $em)
    {
    }
    public function getStrainsQuery(array $data):array
    {
        if($data['query']){
            $query = $this->em->createQuery("SELECT s.id as value, CONCAT(s.name,' (',b.name,')(',s.duration,')') as text FROM App\Entity\Strain s, App\Entity\Breeder b WHERE s.breeder = b.id AND s.name LIKE '%".ucwords($data['query'])."%' ORDER BY trim(s.name) ASC");
            $query->setMaxResults(count($query->getArrayResult()));
            return ['results' => $query->getArrayResult()];
        }else{
            return ['results' => []];
            /*$query = $this->em->createQuery("SELECT s.id as value, CONCAT(s.name,' (',b.name,')') as text FROM App\Entity\Strain s, App\Entity\Breeder b WHERE s.breeder = b.id ORDER BY s.name ASC");
            $query->setMaxResults(50);*/
        }



    }
}
