<?php

namespace Shop\Domain\Repository;

use Shop\Domain\Product;

interface ProductRepositoryInterface
{
    /**
     * @return Product[]
     */
    public function search(): array;

    /**
     * @param string $id
     * @return Product
     */
    public function get(string $id): Product;
}