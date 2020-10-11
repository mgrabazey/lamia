<?php

namespace Shop\App\Calculator;

use Shop\Domain\OrderProduct;
use Shop\Domain\Product;

class StartObserverProduct
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var float|int
     */
    private float $price;

    /**
     * @var int
     */
    private int $count;

    /**
     * StartObserverProduct constructor.
     * @param Product $product
     * @param OrderProduct $orderProduct
     */
    public function __construct(Product $product, OrderProduct $orderProduct)
    {
        $this->id = $product->getId();
        $this->price = $product->getPrice();
        $this->count = $orderProduct->getCount();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount(int $count)
    {
        $this->count = $count;
    }
}