<?php

namespace App\Repository;

use App\Entity\PlantHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlantHistory>
 *
 * @method PlantHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlantHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlantHistory[]    findAll()
 * @method PlantHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlantHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlantHistory::class);
    }

    //    /**
    //     * @return PlantHistory[] Returns an array of PlantHistory objects
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

    //    public function findOneBySomeField($value): ?PlantHistory
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
