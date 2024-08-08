<?php

declare(strict_types=1);

namespace App\Products\Application\Query\GetProductById;

class GetProductByIdQuery
{
    private string $ulid;

    public function __construct(string $ulid)
    {
        $this->ulid = $ulid;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }
}
