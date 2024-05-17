<?php

namespace App\Repository;

use App\Entity\Germination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Germination>
 *
 * @method Germination|null find($id, $lockMode = null, $lockVersion = null)
 * @method Germination|null findOneBy(array $criteria, array $orderBy = null)
 * @method Germination[]    findAll()
 * @method Germination[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GerminationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Germination::class);
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
    //     * @return Germination[] Returns an array of Germination objects
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

    //    public function findOneBySomeField($value): ?Germination
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
