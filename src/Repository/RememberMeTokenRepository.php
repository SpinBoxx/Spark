<?php

namespace App\Repository;

use App\Entity\RememberMeToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RememberMeToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method RememberMeToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method RememberMeToken[]    findAll()
 * @method RememberMeToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RememberMeTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RememberMeToken::class);
    }

    // /**
    //  * @return RememberMeToken[] Returns an array of RememberMeToken objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RememberMeToken
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
