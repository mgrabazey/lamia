<?php

namespace Shop\Api\Protocol\Json;

use JsonException;
use Shop\Domain\Order;
use Shop\Domain\OrderProduct;

class CreateOrderRequest
{
    /**
     * @var string
     */
    public string $countryCode = '';

    /**
     * @var int
     */
    public int $invoiceFormat = 0;

    /**
     * @var bool
     */
    public bool $sendToEmail = false;

    /**
     * @var string|null
     */
    public ?string $email = null;

    /**
     * @var int[]
     * [
     *  id => count,
     *  ...
     * ]
     */
    public array $products = [];

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
        $this->countryCode = $arr['country_code'] ?? '';
        $this->invoiceFormat = $arr['invoice_format'] ?? 0;
        $this->sendToEmail = $arr['send_to_email'] ?? false;
        $this->email = $arr['email'] ?? null;
        $this->products = $arr['products'] ?? [];
    }

    /**
     * @return Order
     */
    public function order(): Order
    {
        $order = new Order();
        $order->setCountryCode($this->countryCode);
        $order->setInvoiceFormat($this->invoiceFormat);
        $order->setSendToEmail($this->sendToEmail);
        $order->setEmail($this->email);
        $products = [];
        foreach ($this->products as $productId => $count) {
            $orderProduct = new OrderProduct();
            $orderProduct->setProductId($productId);
            $orderProduct->setCount($count);
            $products[] = $orderProduct;
        }
        $order->setProducts(...$products);
        return $order;
    }
}