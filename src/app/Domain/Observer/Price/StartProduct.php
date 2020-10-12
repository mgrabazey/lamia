<?php

namespace Shop\Domain\Observer\Price;

use Shop\Domain\OrderProduct;

class StartProduct
{
    /**
     * @var OrderProduct
     */
    private OrderProduct $orderProduct;

    /**
     * @var float
     */
    private float $priceFactor = 0;

    /**
     * StartProduct constructor.
     * @param OrderProduct $orderProduct
     */
    public function __construct(OrderProduct $orderProduct)
    {
        $this->orderProduct = $orderProduct;
    }

    /**
     * @return OrderProduct
     */
    public function product(): OrderProduct
    {
        return $this->orderProduct;
    }

    /**
     * @return float
     */
    public function getPriceFactor(): float
    {
        return $this->priceFactor;
    }

    /**
     * @param float $priceFactor
     */
    public function setPriceFactor(float $priceFactor)
    {
        $this->priceFactor = $priceFactor;
    }
}