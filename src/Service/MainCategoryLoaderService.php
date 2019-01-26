<?php
/**
 * Created by PhpStorm.
 * User: STOYO
 * Date: 20.12.2018 г.
 * Time: 17:48 ч.
 */

namespace App\Service;


use App\Repository\MainCategoryRepository;

class MainCategoryLoaderService
{
    protected $mainCategoryRepository;

    public function __construct(MainCategoryRepository $mainCategoryRepository)
    {
        $this->mainCategoryRepository = $mainCategoryRepository;
    }

    public function getAllMainCategories()
    {
        return $this->mainCategoryRepository->findAll();
    }
}