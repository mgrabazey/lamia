<?php

namespace Shop\Api\Protocol\Json;

use JsonSerializable;
use Shop\Domain\Product;

class ProductsResponse implements JsonSerializable
{
    /**
     * @var ProductsResponse[]
     */
    private array $products;

    /**
     * ProductsResponse constructor.
     * @param Product ...$products
     */
    public function __construct(Product ...$products)
    {
        $this->products = array_map(fn(Product $product) => new ProductResponse($product), $products);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return $this->products;
    }
}