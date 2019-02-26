<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\MainCategory;
use App\Entity\Product;
use App\Entity\SubCategory;
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

    public function getPromotionProductsBy_MainCat(MainCategory $mainCategory)
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

    public function getProductsBy_CategoryLevel(MainCategory $mainCategory, ?SubCategory $subCategory = null, ?Category $category = null)
    {
        $qb = $this->createQueryBuilder('p');
        $qb->andWhere('p.mainCategory = :mainCat', 'p.instock = 1');

        if ($subCategory !== null)
            $qb->andWhere('p.subCategory = :subCat')->setParameter('subCat', $subCategory);
        if ($category !== null)
            $qb->andWhere('p.category = :cat')->setParameter('cat', $category);

        $qb
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

    public function getCountOfProductPagesBy_CategoryLevel(MainCategory $mainCategory, ?SubCategory $subCategory = null, ?Category $category = null)
    {
        $qb = $this->createQueryBuilder('p');
        $qb->andWhere('p.mainCategory = :mainCat', 'p.instock = 1');

        if ($subCategory !== null)
            $qb->andWhere('p.subCategory = :subCat')->setParameter('subCat', $subCategory);
        if ($category !== null)
            $qb->andWhere('p.category = :cat')->setParameter('cat', $category);

        $qb->setParameter('mainCat', $mainCategory);

        $paginator = new Paginator($qb, true);
        $paginatorService = new ProductPaginatorService($paginator);

        return $paginatorService->getPagesCount(self::PRODUCTS_PER_PAGE);
    }

    public function getProductsBy_MainCatWithCriteria(MainCategory $mainCategory, Criteria $criteria, int $page)
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
        $paginatorService = new ProductPaginatorService($paginator);

        return $paginatorService->getAllRecords();
    }

    public function getCountOfProductPagesBy_MainCategoryWithCriteria(MainCategory $mainCategory, Criteria $criteria)
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
        $paginatorService = new ProductPaginatorService($paginator);

        return $paginatorService->getPagesCount(self::PRODUCTS_PER_PAGE);
    }

    public function getProductsBy_MainCat_SubCatWithCriteria(MainCategory $mainCategory, SubCategory $subCategory, Criteria $criteria, int $page)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->andWhere('p.mainCategory = :mainCat', 'p.subCategory = :subCat')
            ->join('p.brand', 'pb')
            ->join('p.productVarieties', 'pv')
            ->addCriteria($criteria)
            ->addSelect('pv')
            ->addSelect('pb')
            ->setParameter('mainCat', $mainCategory)
            ->setParameter('subCat', $subCategory)
            ->setMaxResults(self::PRODUCTS_PER_PAGE)
            ->setFirstResult(($page - 1) * self::PRODUCTS_PER_PAGE);

        $paginator = new Paginator($qb, $fetchJoinCollection = true);
        $paginatorService = new ProductPaginatorService($paginator);

        return $paginatorService->getAllRecords();
    }

    public function getCountOfProductPagesBy_MainCat_SubCatWithCriteria(MainCategory $mainCategory, SubCategory $subCategory, Criteria $criteria)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->andWhere('p.mainCategory = :mainCat', 'p.subCategory = :subCat')
            ->join('p.brand', 'pb')
            ->join('p.productVarieties', 'pv')
            ->addCriteria($criteria)
            ->addSelect('pv')
            ->addSelect('pb')
            ->setParameter('mainCat', $mainCategory)
            ->setParameter('subCat', $subCategory);

        $paginator = new Paginator($qb, $fetchJoinCollection = true);
        $paginatorService = new ProductPaginatorService($paginator);

        return $paginatorService->getPagesCount(self::PRODUCTS_PER_PAGE);
    }

    public function getProductsBy_MainCat_SubCat_CatWithCriteria(MainCategory $mainCategory, SubCategory $subCategory, Category $category, Criteria $criteria, int $page)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->andWhere('p.mainCategory = :mainCat', 'p.subCategory = :subCat', 'p.category = :cat')
            ->join('p.brand', 'pb')
            ->join('p.productVarieties', 'pv')
            ->addCriteria($criteria)
            ->addSelect('pv')
            ->addSelect('pb')
            ->setParameter('mainCat', $mainCategory)
            ->setParameter('subCat', $subCategory)
            ->setParameter('cat', $category)
            ->setMaxResults(self::PRODUCTS_PER_PAGE)
            ->setFirstResult(($page - 1) * self::PRODUCTS_PER_PAGE);

        $paginator = new Paginator($qb, $fetchJoinCollection = true);
        $paginatorService = new ProductPaginatorService($paginator);

        return $paginatorService->getAllRecords();
    }

    public function getCountOfProductPagesBy_MainCat_SubCat_CatWithCriteria(MainCategory $mainCategory, SubCategory $subCategory, Category $category, Criteria $criteria)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->andWhere('p.mainCategory = :mainCat', 'p.subCategory = :subCat', 'p.category = :cat')
            ->join('p.brand', 'pb')
            ->join('p.productVarieties', 'pv')
            ->addCriteria($criteria)
            ->addSelect('pv')
            ->addSelect('pb')
            ->setParameter('mainCat', $mainCategory)
            ->setParameter('subCat', $subCategory)
            ->setParameter('cat', $category);

        $paginator = new Paginator($qb, $fetchJoinCollection = true);
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
