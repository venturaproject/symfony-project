<?php

declare(strict_types=1);

namespace App\Products\Application\Query\GetActiveProducts;

use App\Products\Domain\Repository\ProductRepositoryInterface;

class GetActiveProductsQueryHandler
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(GetActiveProductsQuery $query): array
    {
        return $this->productRepository->findActiveProducts();
    }
}
