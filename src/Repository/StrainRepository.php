<?php

namespace App\Repository;

use App\Entity\Strain;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;

/**
 * @extends ServiceEntityRepository<Strain>
 *
 * @method Strain|null find($id, $lockMode = null, $lockVersion = null)
 * @method Strain|null findOneBy(array $criteria, array $orderBy = null)
 * @method Strain[]    findAll()
 * @method Strain[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StrainRepository extends ServiceEntityRepository
{
    use BaseTrait;

    public function __construct(ManagerRegistry $registry, private readonly Security $security)
    {
        parent::__construct($registry, Strain::class);
    }


    public function countStrains(): int
    {
        return $this->createQueryBuilder('s')
            ->select('count(s.id)')
            ->where('s.userid is NULL')
            ->orWhere('s.userid = :iduser')
            ->setParameter('iduser', $this->security->getUser()->getId())
            ->getQuery()->getSingleScalarResult();
    }
    //    /**
    //     * @return Strain[] Returns an array of Strain objects
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

    //    public function findOneBySomeField($value): ?Strain
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
