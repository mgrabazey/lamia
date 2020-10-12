<?php

namespace Shop\App\Module\Order\Calculator;

use Shop\App\ContainerInterface;
use Shop\Domain\Observer\Price\StartInterface;
use Shop\Domain\Observer\Price\StartProduct;

class CountryTax implements StartInterface
{
    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    /**
     * CountryTax constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritdoc
     */
    public function update(string $countryCode, StartProduct ...$products)
    {
        $this->container->productRepository()->loadTax(
            $countryCode,
            ...array_map(
                fn(StartProduct $product) => $product->product()->getProduct(),
                $products
            )
        );
        foreach ($products as $product) {
            $product->setPriceFactor(
                $product->getPriceFactor() +
                $product->product()->getProduct()->getTax()->getValue()
            );
        }
    }
}