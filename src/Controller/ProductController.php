<?php

namespace App\Controller;

use App\Repository\MainCategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

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

        return $this->render('product/product_content.html.twig',
            [
                'product' => $product
            ]);
    }
}
