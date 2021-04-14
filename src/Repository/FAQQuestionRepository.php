<?php

namespace App\Repository;

use App\Entity\FAQQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FAQQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method FAQQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method FAQQuestion[]    findAll()
 * @method FAQQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FAQQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FAQQuestion::class);
    }

    // /**
    //  * @return FAQQuestion[] Returns an array of FAQQuestion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FAQQuestion
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
