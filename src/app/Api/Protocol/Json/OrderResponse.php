<?php

namespace Shop\Api\Protocol\Json;

use JsonSerializable;
use Shop\Domain\Order;

class OrderResponse implements JsonSerializable
{
    /**
     * @var Order
     */
    private Order $order;

    /**
     * OrderResponse constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $data = [
            'id' => $this->order->getId(),
            'country_code' => $this->order->getCountryCode(),
            'invoice_format' => $this->order->getInvoiceFormat(),
            'send_to_email' => $this->order->getSendToEmail(),
            'email' => $this->order->getEmail(),
            'price' => $this->order->getPrice(),
        ];

        if ($this->order->getProducts()) {
            $data['products'] = new OrderProductsResponse(...$this->order->getProducts());
        }
        return $data;
    }
}