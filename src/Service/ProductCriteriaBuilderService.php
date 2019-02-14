<?php
declare(strict_types=1);
namespace App\Service;

use App\Service\Interfaces\ProductCriteriaBuilderInterface;
use Doctrine\Common\Collections\Criteria;

class ProductCriteriaBuilderService implements ProductCriteriaBuilderInterface
{
    private $criteria;

    public function __construct()
    {
        $this->criteria = Criteria::create();
    }

    public function addInStockCriteria(int $value = 1, string $alias = "p", string $column = "instock")
    {
        $this->criteria
            ->andWhere(Criteria::expr()->eq(self::makeField($alias, $column), $value));

        return $this;
    }

    public function addPriceCriteria(array $prices, string $alias = 'pv', string $column = 'finalPrice')
    {
       $this->criteria
           ->andWhere(Criteria::expr()->gte(self::makeField($alias, $column), $prices[0]))
           ->andWhere(Criteria::expr()->lte(self::makeField($alias, $column), $prices[1]));

        return $this;
    }

    public function addBrandsCriteria(array $brands, string $alias = 'pb', string $column = 'id')
    {
        $this->criteria
            ->andWhere(Criteria::expr()->in(self::makeField($alias, $column), $brands));

        return $this;
    }
    
    public function addInPromotionCriteria(int $value = 0, string $alias = "pv", string $column = 'promotionCut')
    {
        $this->criteria
            ->andWhere(Criteria::expr()->gt(self::makeField($alias, $column), 0));

        return $this;
    }

    public function getCriteria() : Criteria
    {
        return $this->criteria;
    }

    protected static function makeField(string $alias, $column)
    {
        return sprintf("%s.%s", $alias, $column);
    }

}