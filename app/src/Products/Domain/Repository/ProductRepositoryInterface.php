<?php

declare(strict_types=1);

namespace App\Products\Domain\Repository;

use App\Products\Domain\Entity\Product;

interface ProductRepositoryInterface
{
    public function add(Product $product): void;

    public function findByUlid(string $ulid): ?Product; 

    /**
     * @return Product[]  
     */
    public function findActiveProducts(): array;
}
