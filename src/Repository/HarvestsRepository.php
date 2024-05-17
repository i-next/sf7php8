<?php

namespace App\Repository;

use App\Entity\Harvests;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Harvests>
 */
class HarvestsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Harvests::class);
    }

    public function countPlantsByState(int $userId): int
    {
        $req = $this->createQueryBuilder('g')
            ->select('count(g.id)')
            ->where('g.userid = :userid')
            ->andWhere('g.finished = :false')
            ->setParameter('userid', $userId)
            ->setParameter('false', false);

        $res = $req->getQuery()->execute();
        $resarray = $res[array_key_first($res)];

        return $resarray[array_key_first($resarray)];
    }


//    /**
//     * @return Harvests[] Returns an array of Harvests objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Harvests
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
