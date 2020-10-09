<?php

namespace Shop\Infra\Db\MySql\Repository;

use Shop\Domain\Product;
use Shop\Domain\Repository\ProductRepositoryInterface;
use Shop\Infra\Db\TableName;

class ProductRepository extends AbstractRepository implements ProductRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected function table(): string
    {
        return TableName::PRODUCT;
    }

    /**
     * @inheritdoc
     */
    protected function model(): object
    {
        return new Product();
    }

    /**
     * @inheritdoc
     */
    public function search(): array
    {
        return $this->fetchAll();
    }

    /**
     * @inheritdoc
     */
    public function get(string $id): Product
    {
        return $this->fetchByPrimaryKey($id);
    }
}