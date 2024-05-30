<?php

namespace App\Repository;

use App\Entity\ProInfos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProInfos>
 *
 * @method ProInfos|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProInfos|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProInfos[]    findAll()
 * @method ProInfos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProInfosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProInfos::class);
    }

//    /**
//     * @return ProInfos[] Returns an array of ProInfos objects
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

//    public function findOneBySomeField($value): ?ProInfos
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
