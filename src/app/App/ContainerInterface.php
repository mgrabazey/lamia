<?php

namespace Shop\App;

use Shop\Domain\Repository\CountryRepositoryInterface;
use Shop\Domain\Repository\ProductRepositoryInterface;

interface ContainerInterface
{
    /**
     * @return CountryRepositoryInterface
     */
    public function countryRepository(): CountryRepositoryInterface;

    /**
     * @return ProductRepositoryInterface
     */
    public function productRepository(): ProductRepositoryInterface;
}