<?php
declare(strict_types=1);

namespace App\Controller;

use App\Products\ListProducts;
use App\Products\ViewProducts;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductDetailsPageController extends AbstractController
{
    public function __construct(
        private ViewProducts $viewProducts
    ) {
    }

    #[Route('/product-details/{id}')]
    public function productDetails(Request $request): Response
    {
        $id = $request->get('id');
        $product = $this->viewProducts->filterProdById((int)$id);
        return $this->render('product-details.html.twig', ['products' => array($product)]);
    }

//    #[Route('/{id}', name: 'detail')]
//    public function showProductDetails($id): Response
//    {
//        $test = 'Test text' . $id;
//        return new Response($test);
//    }
}