<?php

namespace App\Repository;

use App\Entity\Seeder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Seeder>
 *
 * @method Seeder|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seeder|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seeder[]    findAll()
 * @method Seeder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeederRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Seeder::class);
    }

    //    /**
    //     * @return Seeder[] Returns an array of Seeder objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Seeder
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
