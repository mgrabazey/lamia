<?php

namespace Shop\Infra\Db\MySql\Repository;

use Shop\Domain\OrderProduct;
use Shop\Domain\Repository\OrderProductInterface;
use Shop\Infra\Db\TableName;

class OrderProductRepository extends AbstractRepository implements OrderProductInterface
{
    /**
     * @inheritdoc
     */
    protected string $primaryKey = '';

    /**
     * @inheritdoc
     */
    protected function table(): string
    {
        return TableName::ORDER_PRODUCT;
    }

    /**
     * @inheritdoc
     */
    protected function model(): object
    {
        return new OrderProduct();
    }

    /**
     * @inheritdoc
     */
    public function create(OrderProduct $order)
    {
        $this->insert($order);
    }
}