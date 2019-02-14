<?php

namespace App\Controller;

use App\Entity\MainCategory;
use App\Repository\MainCategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\SubCategoryRepository;
use App\Repository\CategoryRepository;
use App\Service\ProductCriteriaBuilderService;
use App\Service\ProductFilteringHelperService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProductController extends AbstractController
{
    /**
     * @Route("/products/{slug}", name="app_products_maincategory", options = { "expose" = true })
     * @param MainCategory $mainCategory
     * @param Request $request
     * @param ProductFilteringHelperService $productFilter
     * @param ProductCriteriaBuilderService $builder
     * @return Response
     */
    public function getProductsByMainCategory(MainCategory $mainCategory, Request $request, ProductFilteringHelperService $productFilter)
    {
        $q = json_decode($request->getContent(), true);

        $products = $productFilter->getProductsForMainCategoryPage($mainCategory, $q);

        $blocks = $this->renderView('product/product_block.html.twig', [
            'products' => $products,
        ]);

        if ($request->isXmlHttpRequest()) {
            return new Response($blocks);
        }

        return $this->render('product/allproducts_content.html.twig', [
            'mainCategory' => $mainCategory,
            'blocks' => $blocks
        ]);
    }

    /**
     * @Route("/products/{slug}/{slugSub}", name="app_products_main_subcategory", options={ "expose" = true })
     */
    public function getProductsByMain_SubCategory(Request $request, MainCategoryRepository $mainCategoryRepository, SubCategoryRepository $subCategoryRepository, ProductRepository $productRepository)
    {
        $mainCategorySlug = $request->attributes->get('slug');
        $subCategorySlug = $request->attributes->get('slugSub');

        $mainCategory = $mainCategoryRepository->findBy(['slug' => $mainCategorySlug]);
        $mainCategory = array_shift($mainCategory);
        $subCategory = $subCategoryRepository->findBy(['mainCategory' => $mainCategory, 'slugSub' => $subCategorySlug]);
        $subCategory = array_shift($subCategory);

        $products = $productRepository->findBy(['mainCategory' => $mainCategory, 'subCategory' => $subCategory]);
        dump($mainCategory);
        dump($subCategory);
        dd($products);

    }

    /**
     * @Route("/products/{slug}/{slugSub}/{slugCat}", name="app_products_main_sub_category", options={"expose" = true})
     */
    public function getProductsByMain_Sub_Category(Request $request, MainCategoryRepository $mainCategoryRepository, SubCategoryRepository $subCategoryRepository, ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $mainCategorySlug = $request->attributes->get('slug');
        $subCategorySlug = $request->attributes->get('slugSub');
        $categorySlug = $request->attributes->get('slugCat');

        $mainCategory = $mainCategoryRepository->findBy(['slug' => $mainCategorySlug]);
        $mainCategory = array_shift($mainCategory);
        $subCategory = $subCategoryRepository->findBy(['mainCategory' => $mainCategory, 'slugSub' => $subCategorySlug]);
        $subCategory = array_shift($subCategory);
        $category = $categoryRepository->findBy(['mainCategory' => $mainCategory, 'subCategory' => $subCategory, 'slugCat' => $categorySlug]);
        $category = array_shift($category);

        $products = $productRepository->findBy(['mainCategory' => $mainCategory, 'subCategory' => $subCategory, 'category' => $category]);

        dump($mainCategory);
        dump($subCategory);
        dump($category);
        dd($products);
    }

    /**
     * @Route("/products/{main_category}/{sub_category}/{category}/{id}", name="app_product_page")
     * @param ProductRepository $productRepository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function product_page(ProductRepository $productRepository, Request $request)
    {
        $id = $request->attributes->get('id');
        $product = $productRepository->find($id);

        $cookie = new Cookie('TEST_COOKIEE', 'VALUE');
        $response = new Response();
        $response->headers->setCookie($cookie);
        $response->send();
        return $this->render('product/product_selfpage_content.html.twig',
            [
                'product' => $product
            ]);

    }
}
