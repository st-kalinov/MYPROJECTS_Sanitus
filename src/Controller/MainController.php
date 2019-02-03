<?php

namespace App\Controller;

use App\Entity\MainCategory;
use App\Repository\MainCategoryRepository;
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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function main_category(MainCategory $mainCategory)
    {
        return $this->render('product/main_category_content.html.twig', [
            'mainCategory' => $mainCategory,
            'products' => $mainCategory->getProducts()
        ]);
    }

    public function navbarItems(MainCategoryRepository $mainCategoryRepository, Request $request)
    {
        return $this->render('main/nav.html.twig',
            [
                'mainCategories' => $mainCategoryRepository->findNavbarCategories(),
                'active_main_category' => $request->query->get('active_slug')
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
