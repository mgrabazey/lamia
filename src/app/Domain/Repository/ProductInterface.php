<?php

namespace Shop\Domain\Repository;

use Shop\Domain\Product;

interface ProductInterface
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

    /**
     * @param int[] $id
     * @return Product[]
     */
    public function getByIds(array $id): array;

    /**
     * @param string $countryCode
     * @param Product ...$products
     */
    public function loadTax(string $countryCode, Product ...$products);
}