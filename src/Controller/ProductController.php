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
     * @Route("/products/{slug}", name="app_products_maincategory", methods={"GET"}, options = { "expose" = true })
     * @param MainCategory $mainCategory
     * @return Response
     */
    public function getProductsBy_MainCat(MainCategory $mainCategory, ProductRepository $productRepository)
    {
        $pagesCount = $productRepository->getCountOfProductPagesBy_CategoryLevel($mainCategory);
        $products = $productRepository->getProductsBy_CategoryLevel($mainCategory);
        $brands = $productRepository->getProductsBrandsBy_CategoryLevel($mainCategory);

        $blocks = $this->renderView('product/product_block.html.twig', [
            'products' => $products,
            'pagesCount' => $pagesCount,
        ]);

        return $this->render('product/allproducts_maincategory_content.html.twig', [
            'mainCategory' => $mainCategory,
            'brands' => $brands,
            'blocks' => $blocks,
        ]);
    }

    /**
     * @Route("/products/{slug}", name="app_products_maincategory_filtered", methods={"POST"}, condition="request.isXmlHttpRequest()", options={ "expose" = true})
     * @param MainCategory $mainCategory
     * @param Request $request
     * @param ProductFilteringHelperService $productFilter
     * @return Response
     */
    public function getProductBy_MainCatFiltered(MainCategory $mainCategory, Request $request, ProductFilteringHelperService $productFilter)
    {
        $requestParams = json_decode($request->getContent(), true);
        $filtered = $productFilter->getFilteredProductsForMainCategoryPage($mainCategory, $requestParams);

        $products = $filtered['products'];
        $pagesCount = $filtered['pagesCount'];

        $blocks = $this->renderView('product/product_block.html.twig', [
            'products' => $products,
            'pagesCount' => $pagesCount
        ]);

        return new Response($blocks);
    }

    /**
     * @Route("/products/{slug}/{slugSub}", name="app_products_main_subcategory", methods={"GET"}, options={ "expose" = true })
     */
    public function getProductsBy_MainCat_SubCat(Request $request,
                                                 MainCategoryRepository $mainCategoryRepository,
                                                 SubCategoryRepository $subCategoryRepository,
                                                 ProductRepository $productRepository)
    {
        $mainCategorySlug = $request->attributes->get('slug');
        $subCategorySlug = $request->attributes->get('slugSub');

        $mainCategory = $mainCategoryRepository->findOneBy(['slug' => $mainCategorySlug]);
        $subCategory = $subCategoryRepository->findOneBy(['mainCategory' => $mainCategory, 'slugSub' => $subCategorySlug]);

        $products = $productRepository->getProductsBy_CategoryLevel($mainCategory, $subCategory);
        $pagesCount = $productRepository->getCountOfProductPagesBy_CategoryLevel($mainCategory, $subCategory);
        $brands = $productRepository->getProductsBrandsBy_CategoryLevel($mainCategory, $subCategory);

        $blocks = $this->renderView('product/product_block.html.twig', [
            'products' => $products,
            'pagesCount' => $pagesCount
        ]);

        return $this->render('product/allproducts_subcategory_content.html.twig', [
            'mainCategory' => $mainCategory,
            'subCategory' => $subCategory,
            'brands' => $brands,
            'blocks' => $blocks,
        ]);
    }

    /**
     * @Route("/products/{slug}/{slugSub}", name="app_products_main_subcategory_filtered", methods={"POST"}, condition="request.isXmlHttpRequest()", options={ "expose" = true})
     */
    public function getProductsBy_MainCat_SubCatFiltered(Request $request,
                                                         MainCategoryRepository $mainCategoryRepository,
                                                         SubCategoryRepository $subCategoryRepository,
                                                         ProductFilteringHelperService $productFilter)
    {
        $mainCategorySlug = $request->attributes->get('slug');
        $subCategorySlug = $request->attributes->get('slugSub');

        $mainCategory = $mainCategoryRepository->findOneBy(['slug' => $mainCategorySlug]);
        $subCategory = $subCategoryRepository->findOneBy(['mainCategory' => $mainCategory, 'slugSub' => $subCategorySlug]);

        $requestParams = json_decode($request->getContent(), true);
        $filtered = $productFilter->getFilteredProductsForMain_SubCategoryPage($mainCategory, $subCategory, $requestParams);

        $products = $filtered['products'];
        $pagesCount = $filtered['pagesCount'];


        $blocks = $this->renderView('product/product_block.html.twig', [
            'products' => $products,
            'pagesCount' => $pagesCount
        ]);

        return new Response($blocks);
    }

    /**
     * @Route("/products/{slug}/{slugSub}/{slugCat}", name="app_products_main_sub_category", methods={"GET"}, options={"expose" = true})
     */
    public function getProductsBy_MainCat_SubCat_Cat(Request $request,
                                                     MainCategoryRepository $mainCategoryRepository,
                                                     SubCategoryRepository $subCategoryRepository,
                                                     CategoryRepository $categoryRepository,
                                                     ProductRepository $productRepository)
    {
        $mainCategorySlug = $request->attributes->get('slug');
        $subCategorySlug = $request->attributes->get('slugSub');
        $categorySlug = $request->attributes->get('slugCat');

        $mainCategory = $mainCategoryRepository->findOneBy(['slug' => $mainCategorySlug]);
        $subCategory = $subCategoryRepository->findOneBy(['mainCategory' => $mainCategory, 'slugSub' => $subCategorySlug]);
        $category = $categoryRepository->findOneBy(['mainCategory' => $mainCategory, 'subCategory' => $subCategory, 'slugCat' => $categorySlug]);


        $products = $productRepository->getProductsBy_CategoryLevel($mainCategory, $subCategory, $category);
        $pagesCount = $productRepository->getCountOfProductPagesBy_CategoryLevel($mainCategory, $subCategory, $category);
        $brands = $productRepository->getProductsBrandsBy_CategoryLevel($mainCategory, $subCategory, $category);

        $blocks = $this->renderView('product/product_block.html.twig', [
            'products' => $products,
            'pagesCount' => $pagesCount
        ]);

        return $this->render('product/allproducts_category_content.html.twig', [
           'mainCategory' => $mainCategory,
           'subCategory' => $subCategory,
           'category' => $category,
           'brands' => $brands,
           'blocks' => $blocks
        ]);

    }

    /**
     * @Route("/products/{slug}/{slugSub}/{slugCat}", name="app_products_main_sub_category_filtered", methods={"POST"}, condition="request.isXmlHttpRequest()", options={ "expose" = true})
     */
    public function getProductsBy_MainCat_SubCat_CatFiltered(Request $request,
                                                             MainCategoryRepository $mainCategoryRepository,
                                                             SubCategoryRepository $subCategoryRepository,
                                                             CategoryRepository $categoryRepository,
                                                             ProductFilteringHelperService $productFilter)
    {
        $mainCategorySlug = $request->attributes->get('slug');
        $subCategorySlug = $request->attributes->get('slugSub');
        $categorySlug = $request->attributes->get('slugCat');

        $mainCategory = $mainCategoryRepository->findOneBy(['slug' => $mainCategorySlug]);
        $subCategory = $subCategoryRepository->findOneBy(['mainCategory' => $mainCategory, 'slugSub' => $subCategorySlug]);
        $category = $categoryRepository->findOneBy(['mainCategory' => $mainCategory, 'subCategory' => $subCategory, 'slugCat' => $categorySlug]);

        $requestParams = json_decode($request->getContent(), true);
        $filtered = $productFilter->getFilteredProductsForMain_Sub_CategoryPage($mainCategory, $subCategory, $category, $requestParams);

        $products = $filtered['products'];
        $pagesCount = $filtered['pagesCount'];


        $blocks = $this->renderView('product/product_block.html.twig', [
            'products' => $products,
            'pagesCount' => $pagesCount
        ]);

        return new Response($blocks);
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
