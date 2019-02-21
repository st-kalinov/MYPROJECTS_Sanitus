<?php
/**
 * Created by PhpStorm.
 * User: STOYO
 * Date: 21.2.2019 г.
 * Time: 22:21 ч.
 */

namespace App\Service;


use App\Service\Interfaces\ProductPaginatorInterface;

use Doctrine\ORM\Tools\Pagination\Paginator;

class ProductPaginatorService implements ProductPaginatorInterface
{
    public $paginator;

    public function __construct(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    public function getAllRecords()
    {
        $products = [];
        foreach ($this->paginator as $item) {
            $products[] = $item;
        }

        return $products;
    }

    public function getPagesCount(int $productsPerPage)
    {
        $pagesCount = count($this->paginator) / $productsPerPage;

        return ceil($pagesCount);
    }
}