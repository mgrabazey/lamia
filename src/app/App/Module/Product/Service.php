<?php

namespace Shop\App\Module\Product;

use Shop\App\Exception\NotFoundException;
use Shop\App\Module\AbstractService;
use Shop\Domain\Product;

class Service extends AbstractService
{
    /**
     * @return Product[]
     */
    public function search(): array
    {
        return $this->container->productRepository()->search();
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