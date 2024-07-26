<?php

namespace App\Shared\Infrastructure\Controller;

use App\Products\Application\Query\GetActiveProducts\GetActiveProductsQuery;
use App\Products\Application\Query\GetActiveProducts\GetActiveProductsQueryHandler;
use App\Products\Application\Query\GetProductById\GetProductByIdQuery;
use App\Products\Application\Query\GetProductById\GetProductByIdQueryHandler;
use App\Products\Application\DTO\ProductDTO;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    private GetActiveProductsQueryHandler $getActiveProductsQueryHandler;
    private GetProductByIdQueryHandler $getProductByIdQueryHandler;

    public function __construct(
        GetActiveProductsQueryHandler $getActiveProductsQueryHandler,
        GetProductByIdQueryHandler $getProductByIdQueryHandler
    ) {
        $this->getActiveProductsQueryHandler = $getActiveProductsQueryHandler;
        $this->getProductByIdQueryHandler = $getProductByIdQueryHandler;
    }

    #[Route('/products/active', name: 'get_active_products')]
    public function getActiveProducts(): Response
    {
        $query = new GetActiveProductsQuery();
        $products = $this->getActiveProductsQueryHandler->handle($query);

        // Convert the products to DTOs and then to a suitable format for the response
        $data = array_map(
            fn($product) => ProductDTO::fromEntity($product),
            $products
        );

        return $this->render('products/product.html.twig', [
            'products' => $data,
        ]);
    }

    #[Route('/products/{ulid}', name: 'product_details')]
    public function getProductDetails(string $ulid): Response
    {
        $query = new GetProductByIdQuery($ulid);
        $product = $this->getProductByIdQueryHandler->handle($query);

        if (!$product) {
            throw $this->createNotFoundException('Product not found');
        }

        return $this->render('products/product_detail.html.twig', [
            'product' => $product,
        ]);
    }
}
