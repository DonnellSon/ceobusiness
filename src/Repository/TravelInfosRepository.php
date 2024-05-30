<?php

namespace App\Repository;

use App\Entity\TravelInfos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TravelInfos>
 *
 * @method TravelInfos|null find($id, $lockMode = null, $lockVersion = null)
 * @method TravelInfos|null findOneBy(array $criteria, array $orderBy = null)
 * @method TravelInfos[]    findAll()
 * @method TravelInfos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TravelInfosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TravelInfos::class);
    }

//    /**
//     * @return TravelInfos[] Returns an array of TravelInfos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TravelInfos
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
