<?php
namespace App\Service\Interfaces;

use App\Entity\Category;
use App\Entity\MainCategory;
use App\Entity\SubCategory;


interface ProductFilteringHelperInterface {
    public function getFilteredProductsForMainCategoryPage(MainCategory $mainCategory, $requestValues);
    public function getFilteredProductsForMain_SubCategoryPage(MainCategory $mainCategory, SubCategory $subCategory, $requestValues);
    public function getFilteredProductsForMain_Sub_CategoryPage(MainCategory $mainCategory, SubCategory $subCategory, Category $category, $requestValues);
}