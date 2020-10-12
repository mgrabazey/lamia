<?php

namespace Shop\App\Module\Product;

use Shop\App\Module\AbstractService;
use Shop\Domain\Product;

class Service extends AbstractService
{
    /**
     * @param string $countryCode
     * @return Product[]
     */
    public function search(string $countryCode): array
    {
        $repository = $this->container->productRepository();
        $products =  $repository->search();
        $repository->loadTax($countryCode, ...$products);
        return $products;
    }

    /**
     * @param int $id
     * @return Product
     */
    public function get(int $id): Product
    {
        return $this->container->productRepository()->get($id);
    }
}