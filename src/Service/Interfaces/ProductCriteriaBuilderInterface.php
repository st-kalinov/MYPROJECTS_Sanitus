<?php
declare(strict_types=1);

namespace App\Service\Interfaces;


use Doctrine\Common\Collections\Criteria;

interface ProductCriteriaBuilderInterface
{
    public function addInStockCriteria(int $value = 1, string $alias = "p", string $column = "instock");
    public function addPriceCriteria(array $prices, string $alias = 'pv', string $column = 'finalPrice');
    public function addBrandsCriteria(array $brands, string $alias = 'pb', string $column = 'brand');
    public function addInPromotionCriteria(int $value = 0, string $alias = "pv", string $column = 'promotionCut');
    public function getCriteria() : Criteria;

}