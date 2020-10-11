<?php

namespace Shop\Infra\Db\MySql\Repository;

use Shop\Domain\Country;
use Shop\Domain\Order;
use Shop\Domain\OrderProduct;
use Shop\Domain\Repository\OrderProductRepositoryInterface;
use Shop\Domain\Repository\OrderRepositoryInterface;
use Shop\Infra\Db\TableName;

class OrderProductRepository extends AbstractRepository implements OrderProductRepositoryInterface
{
    /**
     * @var string
     */
    protected $primaryKey = '';

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