<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findPromotionProductsByMainCategorySlug($categorySlug)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('pm.slug = :name')
            ->andWhere('pv.promotionCut != 0')
            ->join('p.mainCategory', 'pm' )
            ->join('p.productVarieties', 'pv')
            ->setParameter('name', $categorySlug)
            ->getQuery()
            ->getResult();

    }

    public function findProductsByMainCategorySlug($categorySlug)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('pm.slug = :name')
            ->join('p.mainCategory', 'pm' )
            ->setParameter('name', $categorySlug)
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return ProductFixtures[] Returns an array of ProductFixtures objects
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
    public function findOneBySomeField($value): ?ProductFixtures
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
