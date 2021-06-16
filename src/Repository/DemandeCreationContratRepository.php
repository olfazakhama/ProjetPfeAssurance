<?php

namespace App\Repository;

use App\Entity\DemandeCreationContrat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DemandeCreationContrat|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemandeCreationContrat|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemandeCreationContrat[]    findAll()
 * @method DemandeCreationContrat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeCreationContratRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemandeCreationContrat::class);
    }

    // /**
    //  * @return DemandeCreationContrat[] Returns an array of DemandeCreationContrat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findbyetat($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.etat = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getResult();

    }

    /*
    public function findOneBySomeField($value): ?DemandeCreationContrat
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
