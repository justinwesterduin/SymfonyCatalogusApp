<?php
declare(strict_types=1);

namespace App\Products;

use App\Controller\ProductDetailsPageController;

class ViewProducts extends ListProducts
{
    public function filterProdById(int $id): ProductKeys|null
    {
        $products = $this->fetchJson();
        $filteredProducts = $this->filterProducts($products);

        foreach($filteredProducts as $product) {
            if((int)$product->getId() === $id) {
                return $product;
            }
        }

//        for ($i = 0; $id >= $i; $i++) {
//            if((string)$filteredProducts[$i]->getId() === $id) {
//                return $filteredProducts[$i];
//            }
//        }

        return null;
    }


    #filter by id
    #getId
    #return route product-details/{id}
}