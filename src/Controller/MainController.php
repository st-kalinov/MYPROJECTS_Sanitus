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
    public function homepage(MainCategoryRepository $mainCategoryRepository)
    {
        return $this->render('base.html.twig', [
            'mainCategories' => $mainCategoryRepository->findNavbarCategories(),
        ]);
    }

    /**
     * @Route("/{slug}", name="app_maincategory")
     * @param MainCategory $mainCategory
     * @param ProductRepository $productRepository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function main_category(MainCategory $mainCategory, ProductRepository $productRepository, Request $request)
    {
        $mainCategorySlug = $request->attributes->get('slug');
        return $this->render('product/main_category_content.html.twig', [
            'mainCategory' => $mainCategory,
            'promotions' => $productRepository->findPromotionProductsByMainCategory($mainCategorySlug)
        ]);
    }

    public function navbarItems(MainCategoryRepository $mainCategoryRepository, Request $request)
    {
        $active = $request->query->get('active_slug');

        return $this->render('main/nav.html.twig',
            [
                'mainCategories' => $mainCategoryRepository->findNavbarCategories(),
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
