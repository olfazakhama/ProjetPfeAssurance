<?php

namespace App\Repository;

use App\Entity\Assure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Assure|null find($id, $lockMode = null, $lockVersion = null)
 * @method Assure|null findOneBy(array $criteria, array $orderBy = null)
 * @method Assure[]    findAll()
 * @method Assure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assure::class);
    }

    // /**
    //  * @return Assure[] Returns an array of Assure objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Assure
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
