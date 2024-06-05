<?php

namespace App\Repository;

use App\Entity\CompetitionSubscriber;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompetitionSubscriber>
 *
 * @method CompetitionSubscriber|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompetitionSubscriber|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompetitionSubscriber[]    findAll()
 * @method CompetitionSubscriber[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetitionSubscriberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompetitionSubscriber::class);
    }

//    /**
//     * @return CompetitionSubscriber[] Returns an array of CompetitionSubscriber objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CompetitionSubscriber
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
