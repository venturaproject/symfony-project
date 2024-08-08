<?php

declare(strict_types=1);

namespace App\Products\Application\Query\GetProductById;

use App\Products\Application\DTO\ProductDTO;
use App\Products\Domain\Repository\ProductRepositoryInterface;

class GetProductByIdQueryHandler
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(GetProductByIdQuery $query): ?ProductDTO
    {
        $product = $this->productRepository->findByUlid($query->getUlid());

        if (!$product) {
            return null;
        }

        return ProductDTO::fromEntity($product);
    }
}
