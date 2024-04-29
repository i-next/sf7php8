<?php

namespace App\Repository;

use App\Entity\MySeeds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BaseTrait;
use Symfony\Bundle\SecurityBundle\Security;

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
    use BaseTrait;
    public function __construct(ManagerRegistry $registry, private readonly Security $security)
    {
        parent::__construct($registry, MySeeds::class);
    }

    public function getCountSeed(): int
    {
        $res = $this->createQueryBuilder('s')
            ->select('SUM(s.quantity)')
            ->where('s.userid = :userid')
            ->setParameter('userid', $this->security->getUser()->getId())
            ->getQuery()
            ->execute();
        return reset($res[array_key_first($res)])??0;

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
