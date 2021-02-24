<?php

namespace App\Repository;

use App\Entity\Ideia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ideia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ideia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ideia[]    findAll()
 * @method Ideia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdeiaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ideia::class);
    }

    // /**
    //  * @return Ideia[] Returns an array of Ideia objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ideia
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
