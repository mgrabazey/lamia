<?php

namespace Shop\App\Module\Order;

use Shop\App\Module\AbstractService;
use Shop\Domain\Order;
use Shop\Domain\OrderProduct;

class Service extends AbstractService
{
    /**
     * @return Order[]
     */
    public function search(): array
    {
        return $this->container->orderRepository()->search();
    }

    /**
     * @param int $id
     * @return Order
     */
    public function get(int $id): Order
    {
        return $this->container->orderRepository()->get($id);
    }

    /**
     * @param Order $order
     * @param OrderProduct ...$orderProducts
     */
    public function create(Order $order, OrderProduct ...$orderProducts)
    {
        // TODO: calc price
        $order->setTotalPrice(10);
        // TODO: wrap in transaction
        $this->container->orderRepository()->create($order);
        foreach ($orderProducts as $orderProduct) {
            $orderProduct->setOrderId($order->getId());
            $this->container->orderProductRepository()->create($orderProduct);
        }
    }
}