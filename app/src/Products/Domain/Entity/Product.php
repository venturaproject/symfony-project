<?php

declare(strict_types=1);

namespace App\Products\Domain\Entity;


use App\Shared\Domain\Service\UlidService;

class Product
{

    private string $ulid;

    private ?string $name = null;

    private ?string $sku = null;

    private ?string $description = null;

    private ?float $price = null;

    private ?bool $isActive = null;

    public function __construct(string $name, float $price, string $sku)
    {
        $this->ulid = UlidService::generate();
        $this->name = $name;
        $this->price = $price;
        $this->sku = $sku;
        $this->isActive = false; 
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): static
    {
        $this->sku = $sku;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;
        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;
        return $this;
    }
}
