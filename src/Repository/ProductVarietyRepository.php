<?php

namespace App\Repository;

use App\Entity\ProductVariety;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProductVariety|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductVariety|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductVariety[]    findAll()
 * @method ProductVariety[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductVarietyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProductVariety::class);
    }

    // /**
    //  * @return ProductVariety[] Returns an array of ProductVariety objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductVariety
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
