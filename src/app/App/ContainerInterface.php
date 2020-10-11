<?php

namespace Shop\App;

use Shop\Domain\Repository\CountryRepositoryInterface;
use Shop\Domain\Repository\OrderProductRepositoryInterface;
use Shop\Domain\Repository\OrderRepositoryInterface;
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

    /**
     * @return OrderRepositoryInterface
     */
    public function orderRepository(): OrderRepositoryInterface;

    /**
     * @return OrderProductRepositoryInterface
     */
    public function orderProductRepository(): OrderProductRepositoryInterface;
}