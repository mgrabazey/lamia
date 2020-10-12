<?php

namespace Shop\Api\Protocol\Json;

use JsonSerializable;
use Shop\Domain\Product;

class ProductResponse implements JsonSerializable
{
    /**
     * @var Product
     */
    private Product $product;

    /**
     * ProductResponse constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $data = [
            'id' => $this->product->getId(),
            'name' => $this->product->getName(),
            'description' => $this->product->getDescription(),
            'price' => $this->product->getPrice(),
        ];
        if (!is_null($this->product->getTax())) {
            $data['tax'] = $this->product->getTax()->getValue();
        }
        return $data;
    }
}