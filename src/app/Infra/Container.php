<?php

namespace Shop\Infra;

use PDO;
use Shop\App\ContainerInterface;
use Shop\Domain\Repository\CountryInterface;
use Shop\Domain\Repository\OrderProductInterface;
use Shop\Domain\Repository\OrderInterface;
use Shop\Domain\Repository\ProductInterface;
use Shop\Domain\Repository\TaxInterface;
use Shop\Domain\Service\DatabaseInterface;
use Shop\Infra\Db\MySql\Database;
use Shop\Infra\Db\MySql\Repository\CountryRepository;
use Shop\Infra\Db\MySql\Repository\OrderProductRepository;
use Shop\Infra\Db\MySql\Repository\OrderRepository;
use Shop\Infra\Db\MySql\Repository\ProductRepository;
use Shop\Infra\Db\MySql\Repository\TaxRepository;

class Container implements ContainerInterface
{
    /**
     * @var PDO
     */
    private PDO $databaseConn;

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
    public function databaseService(): DatabaseInterface
    {
        return new Database($this->databaseConn);
    }

    /**
     * @inheritdoc
     */
    public function countryRepository(): CountryInterface
    {
        return new CountryRepository($this->databaseConn);
    }

    /**
     * @inheritdoc
     */
    public function productRepository(): ProductInterface
    {
        return new ProductRepository($this->databaseConn);
    }

    /**
     * @inheritdoc
     */
    public function orderRepository(): OrderInterface
    {
        return new OrderRepository($this->databaseConn);
    }

    /**
     * @inheritdoc
     */
    public function orderProductRepository(): OrderProductInterface
    {
        return new OrderProductRepository($this->databaseConn);
    }

    /**
     * @inheritdoc
     */
    public function taxRepository(): TaxInterface
    {
        return new TaxRepository($this->databaseConn);
    }
}