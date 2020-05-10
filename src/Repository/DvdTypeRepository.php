<?php

namespace App\Repository;

use App\Entity\DvdType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DvdType|null find($id, $lockMode = null, $lockVersion = null)
 * @method DvdType|null findOneBy(array $criteria, array $orderBy = null)
 * @method DvdType[]    findAll()
 * @method DvdType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DvdTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DvdType::class);
    }

    // /**
    //  * @return DvdType[] Returns an array of DvdType objects
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

    /*
    public function findOneBySomeField($value): ?DvdType
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
