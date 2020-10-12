<?php

namespace Shop\Domain\Observer\Order;

use Shop\Domain\Order;

interface OrderInterface
{
    /**
     * @param Order $order
     */
    public function update(Order $order);
}