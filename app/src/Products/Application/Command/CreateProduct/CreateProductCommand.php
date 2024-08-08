<?php

declare(strict_types=1);

namespace App\Products\Application\Command\CreateProduct;

use App\Shared\Application\Command\CommandInterface;

class CreateProductCommand implements CommandInterface
{
    public function __construct(public readonly string $name, public readonly float $price, public readonly string $sku)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getSku(): string
    {
        return $this->sku;
    }
}
