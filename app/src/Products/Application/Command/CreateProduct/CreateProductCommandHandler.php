<?php

declare(strict_types=1);

namespace App\Products\Application\Command\CreateProduct;

use App\Products\Domain\Entity\Product;
use App\Products\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateProductCommandHandler implements CommandHandlerInterface
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(CreateProductCommand $command): void
    {
        $product = new Product($command->getName(), $command->getPrice(), $command->getSku());
        $this->productRepository->add($product);
    }
}
