<?php

namespace Shop\Api\Protocol\Json;

use JsonSerializable;
use Shop\Domain\OrderProduct;

class OrderProductResponse implements JsonSerializable
{
    /**
     * @var OrderProduct
     */
    private OrderProduct $orderProduct;

    /**
     * OrderProductResponse constructor.
     * @param OrderProduct $orderProduct
     */
    public function __construct(OrderProduct $orderProduct)
    {
        $this->orderProduct = $orderProduct;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $data = [
            'order_id' => $this->orderProduct->getOrderId(),
            'product_id' => $this->orderProduct->getProductId(),
            'count' => $this->orderProduct->getCount(),
        ];
        if (!is_null($this->orderProduct->getProduct())) {
            $data['product'] = new ProductResponse($this->orderProduct->getProduct());
        }
        return $data;
    }
}