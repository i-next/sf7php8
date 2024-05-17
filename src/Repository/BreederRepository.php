<?php

namespace App\Repository;

use App\Entity\Breeder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BaseTrait;
use Symfony\Bundle\SecurityBundle\Security;

/**
 * @extends ServiceEntityRepository<Breeder>
 *
 * @method Breeder|null find($id, $lockMode = null, $lockVersion = null)
 * @method Breeder|null findOneBy(array $criteria, array $orderBy = null)
 * @method Breeder[]    findAll()
 * @method Breeder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BreederRepository extends ServiceEntityRepository
{
    use BaseTrait;


    public function __construct(private readonly ManagerRegistry $registry, private readonly Security $security)
    {
        parent::__construct($registry, Breeder::class);
    }

    public function countBreeders(): int
    {
        return $this->createQueryBuilder('b')
            ->select('count(b.id)')
            ->where('b.userid is NULL')
            ->orWhere('b.userid = :iduser')
            ->setParameter('iduser', $this->security->getUser()->getId())
            ->getQuery()->getSingleScalarResult();
    }

    //    /**
    //     * @return Breeder[] Returns an array of Breeder objects
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

    //    public function findOneBySomeField($value): ?Breeder
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
