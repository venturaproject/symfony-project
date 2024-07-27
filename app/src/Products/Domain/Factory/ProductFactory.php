<?php

namespace App\Products\Domain\Factory;

use App\Products\Domain\Entity\Product;
use App\Shared\Domain\Service\UlidService;

class ProductFactory
{
    public function create(string $name, float $price, string $sku, ?string $description = null): Product
    {
        $product = new Product($name, $price, $sku);
        if ($description !== null) {
            $product->setDescription($description);
        }
        return $product;
    }
}
