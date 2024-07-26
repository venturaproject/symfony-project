<?php

declare(strict_types=1);

namespace App\Products\Domain\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Shared\Domain\Service\UlidService;

class Product
{
    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, length: 26, unique: true)]
    private string $ulid;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $sku = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?float $price = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $isActive = null;

    public function __construct(string $name, float $price, ?string $sku = 'DEFAULT_SKU')
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
