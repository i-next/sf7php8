<?php

namespace App\Repository;

use App\Entity\Blooms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Blooms>
 */
class BloomsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blooms::class);
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
    //     * @return Blooms[] Returns an array of Blooms objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Blooms
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
