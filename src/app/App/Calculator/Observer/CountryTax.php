<?php

namespace Shop\App\Calculator\Observer;

use Shop\App\Calculator\StartObserverInterface;
use Shop\App\Calculator\StartObserverProduct;
use Shop\Domain\Repository\TaxInterface;

class CountryTax implements StartObserverInterface
{
    /**
     * @var TaxInterface
     */
    private TaxInterface $repository;

    /**
     * CountryTax constructor.
     * @param TaxInterface $repository
     */
    public function __construct(TaxInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritdoc
     */
    public function update(string $countryCode, StartObserverProduct ...$products)
    {
        $productsMap = [];
        foreach ($products as $product) {
            $productsMap[$product->getId()] = $product;
        }
        foreach ($this->repository->getByCountryAndProducts($countryCode, array_keys($productsMap)) as $tax) {
            $product = $productsMap[$tax->getProductId()];
            $product->setPrice($product->getPrice()*(1+$tax->getValue()));
        }
    }
}