<?php

namespace App\Repository;

use App\Entity\Seed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;

/**
 * @extends ServiceEntityRepository<Seed>
 *
 * @method Seed|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seed|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seed[]    findAll()
 * @method Seed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private readonly Security $security)
    {
        parent::__construct($registry, Seed::class);
    }

    public function getCountSeed(): int
    {
        $res = $this->createQueryBuilder('s')
            ->select('SUM(s.Quantity)')
            ->where('s.userid = :userid')
            ->setParameter('userid', $this->security->getUser()->getId())
            ->getQuery()
            ->execute();
        return reset($res[array_key_first($res)]);

    }

    //    /**
    //     * @return Seed[] Returns an array of Seed objects
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

    //    public function findOneBySomeField($value): ?Seed
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
