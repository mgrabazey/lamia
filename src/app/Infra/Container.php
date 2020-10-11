<?php

namespace Shop\Infra;

use PDO;
use Shop\App\ContainerInterface;
use Shop\Domain\Repository\CountryRepositoryInterface;
use Shop\Domain\Repository\OrderProductRepositoryInterface;
use Shop\Domain\Repository\OrderRepositoryInterface;
use Shop\Domain\Repository\ProductRepositoryInterface;
use Shop\Infra\Db\MySql\Repository\CountryRepository;
use Shop\Infra\Db\MySql\Repository\OrderProductRepository;
use Shop\Infra\Db\MySql\Repository\OrderRepository;
use Shop\Infra\Db\MySql\Repository\ProductRepository;

class Container implements ContainerInterface
{
    /**
     * @var PDO
     */
    private $databaseConn;

    /**
     * Factory constructor.
     * @param PDO $databaseConn
     */
    public function __construct(PDO $databaseConn)
    {
        $this->databaseConn = $databaseConn;
    }

    /**
     * @inheritdoc
     */
    public function countryRepository(): CountryRepositoryInterface
    {
        return new CountryRepository($this->databaseConn);
    }

    /**
     * @inheritdoc
     */
    public function productRepository(): ProductRepositoryInterface
    {
        return new ProductRepository($this->databaseConn);
    }

    /**
     * @inheritdoc
     */
    public function orderRepository(): OrderRepositoryInterface
    {
        return new OrderRepository($this->databaseConn);
    }

    /**
     * @inheritdoc
     */
    public function orderProductRepository(): OrderProductRepositoryInterface
    {
        return new OrderProductRepository($this->databaseConn);
    }
}