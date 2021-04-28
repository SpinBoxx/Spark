<?php

namespace App\Repository;

use App\Entity\FAQTheme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FAQTheme|null find($id, $lockMode = null, $lockVersion = null)
 * @method FAQTheme|null findOneBy(array $criteria, array $orderBy = null)
 * @method FAQTheme[]    findAll()
 * @method FAQTheme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FAQThemeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FAQTheme::class);
    }

    // /**
    //  * @return FAQTheme[] Returns an array of FAQTheme objects
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
    public function findOneBySomeField($value): ?FAQTheme
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
