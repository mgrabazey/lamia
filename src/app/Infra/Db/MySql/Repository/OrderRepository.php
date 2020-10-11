<?php

namespace Shop\Infra\Db\MySql\Repository;

use Shop\Domain\Country;
use Shop\Domain\Order;
use Shop\Domain\Repository\OrderRepositoryInterface;
use Shop\Infra\Db\TableName;

class OrderRepository extends AbstractRepository implements OrderRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected function table(): string
    {
        return TableName::ORDER;
    }

    /**
     * @inheritdoc
     */
    protected function model(): object
    {
        return new Order();
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
    public function get(string $code): Order
    {
        return $this->fetchByPrimaryKey($code);
    }

    /**
     * @inheritdoc
     */
    public function create(Order $order)
    {
        $order->setId($this->insert($order));
    }
}