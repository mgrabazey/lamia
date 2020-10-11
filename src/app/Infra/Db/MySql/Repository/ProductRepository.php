<?php

namespace Shop\Infra\Db\MySql\Repository;

use Shop\Domain\Product;
use Shop\Domain\Repository\ProductInterface;
use Shop\Infra\Db\TableName;

class ProductRepository extends AbstractRepository implements ProductInterface
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

    /**
     * @inheritdoc
     */
    public function getByIds(array $ids): array
    {
        return $this->fetchByPrimaryKeys($ids);
    }


}