<?php

namespace App\Products\Infrastructure\Repository;

use App\Products\Domain\Entity\Product;
use App\Products\Domain\Repository\ProductRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class ProductRepository implements ProductRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Product $product): void
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    public function findByUlid(string $ulid): ?Product
    {
        return $this->entityManager->getRepository(Product::class)->find($ulid);
    }

    /**
     * @return Product[]  
     */
    public function findActiveProducts(): array
    {
        return $this->entityManager->getRepository(Product::class)->findBy(['isActive' => true]);
    }
}