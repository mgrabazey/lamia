<?php

namespace Shop\Api\Protocol\Json;

use JsonSerializable;
use Shop\Domain\OrderProduct;

class OrderProductsResponse implements JsonSerializable
{
    /**
     * @var OrderProductResponse[]
     */
    private array $orderProducts;

    /**
     * CountriesResponse constructor.
     * @param OrderProduct ...$orderProducts
     */
    public function __construct(OrderProduct ...$orderProducts)
    {
        $this->orderProducts = array_map(fn(OrderProduct $orderProduct) => new OrderProductResponse($orderProduct), $orderProducts);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return $this->orderProducts;
    }
}