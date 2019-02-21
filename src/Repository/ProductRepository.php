<?php

namespace App\Repository;

use App\Entity\MainCategory;
use App\Entity\Product;
use App\Service\ProductPaginatorService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    const PRODUCTS_PER_PAGE = 10;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getPromotionProductsByMainCategory(MainCategory $mainCategory)
    {
        return $this->createQueryBuilder('p')
            ->select('p.id', 'p.name', 'p.img', 'pv.finalPrice', 'pv.price', 'pm.slug', 'ps.slugSub', 'pg.slugCat')
            ->andWhere('p.mainCategory = :mainCat', 'pv.promotionCut != 0', 'p.instock = 1')
            ->join('p.mainCategory', 'pm')
            ->join('p.subCategory', 'ps')
            ->join('p.category', 'pg')
            ->join('p.productVarieties', 'pv')
            ->setParameter('mainCat', $mainCategory)
            ->getQuery()
            ->getResult();
    }

    public function getProductsByMainCategoryWithCriteria($mainCategory, Criteria $criteria, int $page)
    {

        $qb = $this->createQueryBuilder('p');
        $qb
            ->andWhere('p.mainCategory = :mainCat')
            ->join('p.brand', 'pb')
            ->join('p.productVarieties', 'pv')
            ->addCriteria($criteria)
            ->addSelect('pv')
            ->addSelect('pb')
            ->setParameter('mainCat', $mainCategory)
            ->setMaxResults(self::PRODUCTS_PER_PAGE)
            ->setFirstResult(($page - 1) * self::PRODUCTS_PER_PAGE);

        $paginator = new Paginator($qb, $fetchJoinCollection = true);
        $products = [];
        foreach ($paginator as $post) {
            $products[] = $post;
        }

        return $products;
    }

    public function getCountOfProductPages_ByMainCategoryWithCriteria($mainCategory, Criteria $criteria)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->andWhere('p.mainCategory = :mainCat')
            ->join('p.brand', 'pb')
            ->join('p.productVarieties', 'pv')
            ->addCriteria($criteria)
            ->addSelect('pv')
            ->addSelect('pb')
            ->setParameter('mainCat', $mainCategory);

        $paginator = new Paginator($qb, $fetchJoinCollection = true);
        $pagesCount = count($paginator) / self::PRODUCTS_PER_PAGE;

        return ceil($pagesCount);
    }

    public function getProductsByMainCategory($mainCategory)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->andWhere('p.mainCategory = :mainCat', 'p.instock = 1')
            ->join('p.brand', 'pb')
            ->join('p.productVarieties', 'pv')
            ->addSelect('pv')
            ->addSelect('pb')
            ->setParameter('mainCat', $mainCategory)
            ->setMaxResults(self::PRODUCTS_PER_PAGE);

        $paginator = new Paginator($qb, true);
        $paginatorService = new ProductPaginatorService($paginator);

        return $paginatorService->getAllRecords();
    }

    public function getCountOfProductPages_ByMainCategory($mainCategory)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->andWhere('p.mainCategory = :mainCat', 'p.instock = 1')
            ->setParameter('mainCat', $mainCategory);

        $paginator = new Paginator($qb, true);
        $paginatorService = new ProductPaginatorService($paginator);

        return $paginatorService->getPagesCount(self::PRODUCTS_PER_PAGE);
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
