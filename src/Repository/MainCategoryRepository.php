<?php

namespace App\Repository;

use App\Entity\MainCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MainCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainCategory[]    findAll()
 * @method MainCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MainCategory::class);
    }

    public function findTopbarCategories()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.place = :val')
            ->setParameter('val', 'info')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findNavbarCategories()
    {
        return $this->createQueryBuilder('m')
            ->leftJoin('m.subcategory', 'ms')
            ->leftJoin('m.brand', 'mb')
            ->leftJoin('ms.category', 'msc')
            ->addSelect('ms', 'mb')
            ->addSelect('msc')
            ->andWhere('m.place = :val')
            ->setParameter('val', 'nav')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findAllProductsByMainCategory($mainCategory) {
        return $this->createQueryBuilder('a')
            ->andWhere('a.name = :val')
            ->setParameter('val', $mainCategory)
            ->getQuery()
            ->getResult();

    }
    // /**
    //  * @return MainCategory[] Returns an array of MainCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MainCategory
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
