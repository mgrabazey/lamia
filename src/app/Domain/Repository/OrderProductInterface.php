<?php

namespace Shop\Domain\Repository;

use Shop\Domain\OrderProduct;

interface OrderProductInterface
{
    /**
     * @param OrderProduct $orderProduct
     */
    public function create(OrderProduct $orderProduct);

    /**
     * @param OrderProduct ...$orderProducts
     */
    public function loadProduct(OrderProduct ...$orderProducts);
}