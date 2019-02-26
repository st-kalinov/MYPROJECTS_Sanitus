<?php
namespace App\Service;

use App\Entity\Category;
use App\Entity\MainCategory;
use App\Entity\SubCategory;
use App\Repository\ProductRepository;
use App\Service\Interfaces\ProductFilteringHelperInterface;
use http\Exception\InvalidArgumentException;


class ProductFilteringHelperService implements ProductFilteringHelperInterface
{
    const PRICE = [1,300];
    protected $productRepository;
    protected $builder;

    public function __construct(ProductRepository $productRepository, ProductCriteriaBuilderService $builder)
    {
        $this->productRepository = $productRepository;
        $this->builder = $builder;
    }

    public function getFilteredProductsForMainCategoryPage(MainCategory $mainCategory, $requestValues)
    {
        if($requestValues === null) {
            throw new InvalidArgumentException('Invalid filtering arguments');
        }
        $prices = $requestValues['price'] === null || empty($requestValues['price'])  ? self::PRICE : $requestValues['price'];
        $page = $requestValues['page'];

        $this->builder
            ->addInStockCriteria(true)
            ->addPriceCriteria($prices);

        $this->requestArgumentsChecker('brand', $requestValues) ? $this->builder->addBrandsCriteria($requestValues['brand']) : null;
        $this->requestArgumentsChecker('promotion', $requestValues) ? $this->builder->addInPromotionCriteria() : null;

        $criteria = $this->builder->getCriteria();

        return [
            'products' => $this->productRepository->getProductsBy_MainCatWithCriteria($mainCategory, $criteria, $page),
            'pagesCount' => $this->productRepository->getCountOfProductPagesBy_MainCategoryWithCriteria($mainCategory, $criteria)
            ];
    }

    public function getFilteredProductsForMain_SubCategoryPage(MainCategory $mainCategory, SubCategory $subCategory, $requestValues)
    {
        if($requestValues === null) {
            throw new InvalidArgumentException('Invalid filtering arguments');
        }
        $prices = $requestValues['price'] === null || empty($requestValues['price'])  ? self::PRICE : $requestValues['price'];
        $page = $requestValues['page'];

        $this->builder
            ->addInStockCriteria(true)
            ->addPriceCriteria($prices);

        $this->requestArgumentsChecker('brand', $requestValues) ? $this->builder->addBrandsCriteria($requestValues['brand']) : null;
        $this->requestArgumentsChecker('promotion', $requestValues) ? $this->builder->addInPromotionCriteria() : null;

        $criteria = $this->builder->getCriteria();

        return [
            'products' => $this->productRepository->getProductsBy_MainCat_SubCatWithCriteria($mainCategory, $subCategory, $criteria, $page),
            'pagesCount' => $this->productRepository->getCountOfProductPagesBy_MainCat_SubCatWithCriteria($mainCategory, $subCategory, $criteria)
        ];
    }

    public function getFilteredProductsForMain_Sub_CategoryPage(MainCategory $mainCategory, SubCategory $subCategory, Category $category, $requestValues)
    {
        if($requestValues === null) {
            throw new InvalidArgumentException('Invalid filtering arguments');
        }
        $prices = $requestValues['price'] === null || empty($requestValues['price'])  ? self::PRICE : $requestValues['price'];
        $page = $requestValues['page'];

        $this->builder
            ->addInStockCriteria(true)
            ->addPriceCriteria($prices);

        $this->requestArgumentsChecker('brand', $requestValues) ? $this->builder->addBrandsCriteria($requestValues['brand']) : null;
        $this->requestArgumentsChecker('promotion', $requestValues) ? $this->builder->addInPromotionCriteria() : null;

        $criteria = $this->builder->getCriteria();

        return [
            'products' => $this->productRepository->getProductsBy_MainCat_SubCat_CatWithCriteria($mainCategory, $subCategory, $category, $criteria, $page),
            'pagesCount' => $this->productRepository->getCountOfProductPagesBy_MainCat_SubCat_CatWithCriteria($mainCategory, $subCategory, $category, $criteria)
        ];
    }

    private function requestArgumentsChecker($key, $requestValues)
    {
        if(!key_exists($key, $requestValues) || empty($requestValues[$key])) {
            return false;
        }

        return true;
    }

}