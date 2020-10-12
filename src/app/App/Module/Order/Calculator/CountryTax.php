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
        $productsMap = [];
        foreach ($products as $product) {
            $productsMap[$product->getId()] = $product;
        }
        foreach ($this->container->taxRepository()->getByCountryAndProducts($countryCode, array_keys($productsMap)) as $tax) {
            $product = $productsMap[$tax->getProductId()];
            $product->setPrice($product->getPrice()*(1+$tax->getValue()));
        }
    }
}