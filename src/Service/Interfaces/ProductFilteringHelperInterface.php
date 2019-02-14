<?php
namespace App\Service\Interfaces;

use App\Entity\Category;
use App\Entity\MainCategory;
use App\Entity\SubCategory;


interface ProductFilteringHelperInterface {
    public function getProductsForMainCategoryPage(MainCategory $mainCategory, $requestValues);
    public function getProductsForMain_SubCategoryPage(MainCategory $mainCategory, SubCategory $subCategory);
    public function getProductsForMain_Sub_CategoryPage(MainCategory $mainCategory, SubCategory $subCategory, Category $category );
}