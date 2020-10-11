<?php

namespace Shop\Domain\Repository;

use Shop\Domain\OrderProduct;

interface OrderProductRepositoryInterface
{
    /**
     * @param OrderProduct $orderProduct
     */
    public function create(OrderProduct $orderProduct);
}