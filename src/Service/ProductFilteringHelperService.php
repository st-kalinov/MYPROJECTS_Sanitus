<?php
namespace App\Service;

use App\Entity\Category;
use App\Entity\MainCategory;
use App\Entity\SubCategory;
use App\Repository\ProductRepository;
use App\Service\Interfaces\ProductFilteringHelperInterface;


class ProductFilteringHelperService implements ProductFilteringHelperInterface
{
    protected $productRepository;
    protected $builder;

    public function __construct(ProductRepository $productRepository, ProductCriteriaBuilderService $builder)
    {
        $this->productRepository = $productRepository;
        $this->builder = $builder;
    }

    public function getProductsForMainCategoryPage(MainCategory $mainCategory, $requestValues)
    {
        $prices = $requestValues['price'] === null ? [1, 300] : $requestValues['price'];

         $this->builder
            ->addInStockCriteria(true)
            ->addPriceCriteria($prices);

        if($requestValues !== null && key_exists('brand', $requestValues) && !empty($requestValues['brand'])) {
            $this->builder->addBrandsCriteria($requestValues['brand']);
        }
        if($requestValues !== null && key_exists('promotion', $requestValues)) {
            $this->builder->addInPromotionCriteria();
        }

        $criteria = $this->builder->getCriteria();

        return $this->productRepository->getProductsByMainCategoryWithCriteria($mainCategory, $criteria);
    }

    public function getProductsForMain_SubCategoryPage(MainCategory $mainCategory, SubCategory $subCategory)
    {
        // TODO: Implement getProductsForMain_SubCategoryPage() method.
    }

    public function getProductsForMain_Sub_CategoryPage(MainCategory $mainCategory, SubCategory $subCategory, Category $category)
    {
        // TODO: Implement getProductsForMain_Sub_CategoryPage() method.
    }
}