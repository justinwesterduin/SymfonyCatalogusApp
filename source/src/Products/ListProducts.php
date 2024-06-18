<?php
declare(strict_types=1);

namespace App\Products;

class ListProducts extends ImportApi
{
    public function fetchJson()
    {
        $projectDir = $this->kernel->getProjectDir();
        $contentResult = file_get_contents($projectDir . '/resources/products.inc.json');
        $productInfo = json_decode($contentResult, true, 512,);
        return $productInfo;
    }
    public function filterProducts($productInfo): array
    {
        $products = [];

        foreach ($productInfo as $productInfoKey) {
            $products[] = new ProductKeys(
                $productInfoKey['id'],
                $productInfoKey[ 'title' ],
                $productInfoKey[ 'price' ],
                $productInfoKey[ 'image' ],
                $productInfoKey[ 'category' ],
                $productInfoKey[ 'description' ]
            );
        }
        return $products;
    }
}