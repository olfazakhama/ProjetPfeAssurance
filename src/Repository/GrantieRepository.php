<?php

namespace App\Repository;

use App\Entity\Grantie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Grantie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grantie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grantie[]    findAll()
 * @method Grantie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrantieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grantie::class);
    }

    // /**
    //  * @return Grantie[] Returns an array of Grantie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Grantie
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
