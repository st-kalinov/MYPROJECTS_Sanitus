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
            'products' => $this->productRepository->getProductsByMainCategoryWithCriteria($mainCategory, $criteria, $page),
            'pagesCount' => $this->productRepository->getCountOfProductPages_ByMainCategoryWithCriteria($mainCategory, $criteria)
            ];
    }

    public function getProductsForMain_SubCategoryPage(MainCategory $mainCategory, SubCategory $subCategory)
    {
        // TODO: Implement getProductsForMain_SubCategoryPage() method.
    }

    public function getProductsForMain_Sub_CategoryPage(MainCategory $mainCategory, SubCategory $subCategory, Category $category)
    {
        // TODO: Implement getProductsForMain_Sub_CategoryPage() method.
    }

    private function requestArgumentsChecker($key, $requestValues)
    {
        if(!key_exists($key, $requestValues) || empty($requestValues[$key])) {
            return false;
        }

        return true;
    }

}