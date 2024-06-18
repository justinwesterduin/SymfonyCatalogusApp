<?php
declare(strict_types=1);

namespace App\Controller;

use App\Products\ListProducts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductListPageController extends AbstractController
{
    public function __construct(
        private ListProducts $listProducts
    ){
    }

    /**
     * @throws \JsonException
     */
    #[Route('/product-list', name: 'product_listing')]
    public function productList (Request $request): Response
    {

        $productInfo = $this->listProducts->fetchJson();
        $productList = $this->listProducts->filterProducts($productInfo);
        return $this->render('product-list.html.twig', ['products' => $productList]);
    }
}