<?php

namespace App\Repository;

use App\Entity\Quality;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Quality|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quality|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quality[]    findAll()
 * @method Quality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QualityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quality::class);
    }

    // /**
    //  * @return Quality[] Returns an array of Quality objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Quality
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
