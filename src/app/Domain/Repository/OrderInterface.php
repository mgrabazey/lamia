<?php

namespace Shop\Domain\Repository;

use Shop\Domain\Order;

interface OrderInterface
{
    /**
     * @return Order[]
     */
    public function search(): array;

    /**
     * @param string $code
     * @return Order
     */
    public function get(string $code): Order;

    /**
     * @param Order $order
     */
    public function create(Order $order);
}