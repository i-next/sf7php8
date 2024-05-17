<?php

namespace App\Repository;

use App\Entity\EnumStates;
use App\Entity\Plant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Plant>
 *
 * @method Plant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plant[]    findAll()
 * @method Plant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plant::class);
    }

    public function countPlantsByState(string $state, int $userId): int
    {

        $req = $this->createQueryBuilder('p')
            ->select('count(p.id)')
            ->where('p.userid = :userid')
            ->setParameter('userid', $userId);
        if($state != '*') {
            $req->andWhere('p.state = :state')
            ->setParameter('state', $state);
        }
        $res = $req->getQuery()->execute();
        $resarray = $res[array_key_first($res)];

        return $resarray[array_key_first($resarray)];
    }

    public function countPlantsAllStates(int $userId): array
    {

        $res = $this->createQueryBuilder('p')
            ->select('p.state, count(p.id)')
            ->groupBy('p.state')
            ->where('p.userid = :userid')
            ->setParameter('userid', $userId)
            ->getQuery()
            ->getResult();
        return $res;
    }

    //    /**
    //     * @return Plant[] Returns an array of Plant objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Plant
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
