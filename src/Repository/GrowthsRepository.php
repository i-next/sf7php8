<?php

namespace App\Repository;

use App\Entity\Growths;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Growths>
 *
 * @method Growths|null find($id, $lockMode = null, $lockVersion = null)
 * @method Growths|null findOneBy(array $criteria, array $orderBy = null)
 * @method Growths[]    findAll()
 * @method Growths[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrowthsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Growths::class);
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
    //     * @return Growths[] Returns an array of Growths objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Growths
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
