<?php

namespace App\Repository;

use App\Entity\PersoInfos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PersoInfos>
 *
 * @method PersoInfos|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersoInfos|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersoInfos[]    findAll()
 * @method PersoInfos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersoInfosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersoInfos::class);
    }

//    /**
//     * @return PersoInfos[] Returns an array of PersoInfos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PersoInfos
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
