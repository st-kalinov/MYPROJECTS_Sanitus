<?php

namespace App\Controller;

use App\Entity\MainCategory;
use App\Repository\MainCategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('base.html.twig', []);
    }

    /**
     * @Route("/{slug}", name="app_maincategory")
     * @param MainCategory $mainCategory
     * @param ProductRepository $productRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function main_category(MainCategory $mainCategory, ProductRepository $productRepository)
    {

       $promotionProducts = $productRepository->getPromotionProductsBy_MainCat($mainCategory);

        return $this->render('product/main_category_content.html.twig', [
            'mainCategory' => $mainCategory,
            'promotions' => $promotionProducts
        ]);
    }

    public function navbarItems(MainCategoryRepository $mainCategoryRepository, Request $request)
    {
        $active = $request->query->get('active_slug');
        $mainCategories = $mainCategoryRepository->findNavbarCategories();

        return $this->render('main/nav.html.twig',
            [
                'mainCategories' => $mainCategories,
                'active_main_category' => $active !== null ? array_shift($active) : null
            ]
        );
    }

    public function topbarItems(MainCategoryRepository $mainCategoryRepository)
    {
        return $this->render('main/topbar.html.twig',
            [
                'mainCategories' => $mainCategoryRepository->findTopbarCategories()
            ]
        );
    }
}
