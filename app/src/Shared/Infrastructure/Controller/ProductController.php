<?php

namespace App\Shared\Infrastructure\Controller;

use App\Products\Application\Query\GetActiveProducts\GetActiveProductsQuery;
use App\Products\Application\Query\GetActiveProducts\GetActiveProductsQueryHandler;
use App\Products\Application\DTO\ProductDTO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    private GetActiveProductsQueryHandler $queryHandler;

    public function __construct(GetActiveProductsQueryHandler $queryHandler)
    {
        $this->queryHandler = $queryHandler;
    }

    #[Route('/products/active', name: 'get_active_products')]
    public function getActiveProducts(): JsonResponse
    {
        $query = new GetActiveProductsQuery();
        $products = $this->queryHandler->handle($query);

        // Convert the products to DTOs and then to a suitable format for the response
        $data = array_map(
            fn($product) => ProductDTO::fromEntity($product),
            $products
        );

        return new JsonResponse($data);
    }
}
