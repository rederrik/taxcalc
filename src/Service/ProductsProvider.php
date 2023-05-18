<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;

final class ProductsProvider
{
    private array $products;

    public function __construct(array $productsConfig)
    {
        $this->products = array_map(function($productConfig) {
            return new Product($productConfig['name'], $productConfig['price']);
        }, $productsConfig);
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}
