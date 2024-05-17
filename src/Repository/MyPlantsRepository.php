<?php

namespace App\Repository;

use App\Entity\Germination;
use App\Entity\MyPlants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;

/**
 * @extends ServiceEntityRepository<MyPlants>
 *
 * @method MyPlants|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyPlants|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyPlants[]    findAll()
 * @method MyPlants[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyPlantsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private readonly Security $security)
    {
        parent::__construct($registry, MyPlants::class);
    }

    public function getAll(): array
    {
        $qb = $this->createQueryBuilder('mp')

            ->leftJoin('mp.germination', 'germination')->where('germination = mp.germination')->addSelect('germination')
            ->leftJoin('mp.growths', 'growths')->where('growths = mp.growths')->addSelect('growths')
            ->leftJoin('mp.preblooms', 'preblooms')->where('preblooms = mp.preblooms')->addSelect('preblooms')
            ->leftJoin('mp.blooms', 'blooms')->where('blooms = mp.blooms')->addSelect('blooms')
            ->leftJoin('mp.my_seeds', 'my_seeds')->where('my_seeds = mp.my_seeds')->addSelect('my_seeds')
            ->leftJoin('my_seeds.strain', 'strain')->where('strain = my_seeds.strain')->addSelect('strain')
            ->leftJoin('strain.breeder', 'breeder')->where('breeder = strain.breeder')->addSelect('breeder')
            ->where('mp.userid = '.$this->security->getUser()->getId())
            ->andWhere('mp.finished = :false')
            ->setParameter('false',false)
            ->orderBy('mp.name', 'ASC');

        return $qb->getQuery()->getArrayResult();
    }

    //    /**
    //     * @return MyPlants[] Returns an array of MyPlants objects
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
    //leftJoin('q.'.$tablejoin, $tablejoin)->where($tablejoin.' = q.'.$tablejoin)->addSelect($tablejoin);

    //    public function findOneBySomeField($value): ?MyPlants
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
