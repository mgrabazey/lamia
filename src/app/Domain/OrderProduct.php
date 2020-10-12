<?php

namespace Shop\Domain;

class OrderProduct
{
    /**
     * @var int
     */
    private int $_orderId = 0;

    /**
     * @var int
     */
    private int $_productId = 0;

    /**
     * @var int
     */
    private int $_count = 0;

    /**
     * @var Product|null
     */
    private ?Product $product = null;

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->_orderId;
    }

    /**
     * @param int $_orderId
     */
    public function setOrderId(int $_orderId)
    {
        $this->_orderId = $_orderId;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->_productId;
    }

    /**
     * @param int $_productId
     */
    public function setProductId(int $_productId)
    {
        $this->_productId = $_productId;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->_count;
    }

    /**
     * @param int $_count
     */
    public function setCount(int $_count)
    {
        $this->_count = $_count;
    }

    /**
     * @return Product|null
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product|null $product
     */
    public function setProduct(Product $product = null)
    {
        $this->product = $product;
    }
}