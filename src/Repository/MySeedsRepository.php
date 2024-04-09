<?php

namespace App\Repository;

use App\Entity\MySeeds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MySeeds>
 *
 * @method MySeeds|null find($id, $lockMode = null, $lockVersion = null)
 * @method MySeeds|null findOneBy(array $criteria, array $orderBy = null)
 * @method MySeeds[]    findAll()
 * @method MySeeds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MySeedsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MySeeds::class);
    }

//    /**
//     * @return MySeeds[] Returns an array of MySeeds objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MySeeds
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
