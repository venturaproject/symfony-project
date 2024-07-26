<?php

declare(strict_types=1);

namespace App\Products\Application\DTO;

use App\Products\Domain\Entity\Product;

class ProductDTO
{
    public function __construct(
        public readonly string $ulid,
        public readonly string $name,
        public readonly ?string $sku,
        public readonly ?string $description,
        public readonly float $price,
        public readonly bool $isActive
    ) {
    }

    public static function fromEntity(Product $product): self
    {
        return new self(
            $product->getUlid(),
            $product->getName(),
            $product->getSku(),
            $product->getDescription(),
            $product->getPrice(),
            $product->getIsActive()
        );
    }
}
