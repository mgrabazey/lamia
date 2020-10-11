<?php

namespace Shop\Api\Protocol\Json;

use JsonException;
use Shop\Domain\Order;
use Shop\Domain\OrderProduct;

class CreateOrder
{
    /**
     * @var string
     */
    public $countryCode;

    /**
     * @var string|null
     */
    public $email;

    /**
     * @var int[]
     * [
     *  id => count,
     *  ...
     * ]
     */
    public $products;

    /**
     * @param string $raw
     * @return static
     * @throws JsonException
     */
    public static function create(string $raw): self
    {
        return new static($raw);
    }

    /**
     * CreateOrder constructor.
     * @param string $raw
     * @throws JsonException
     */
    private function __construct(string $raw)
    {
        $arr = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
        $this->countryCode = $arr['country_code'];
        $this->email = $arr['email'];
        $this->products = $arr['products'];
    }

    /**
     * @return Order
     */
    public function order(): Order
    {
        $order = new Order();
        $order->setCountryCode($this->countryCode);
        $order->setEmail($this->email);
        return $order;
    }

    /**
     * @return OrderProduct[]
     */
    public function orderProducts(): array
    {
        $arr = [];
        foreach ($this->products as $productId => $count) {
            $orderProduct = new OrderProduct();
            $orderProduct->setProductId($productId);
            $orderProduct->setCount($count);
            $arr[] = $orderProduct;
        }
        return $arr;
    }
}