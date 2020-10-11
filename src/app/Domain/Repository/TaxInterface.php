<?php

namespace Shop\Domain\Repository;

use Shop\Domain\Tax;

interface TaxInterface
{
    /**
     * @param string $countryCode
     * @param int[] $productIds
     * @return Tax[]
     */
    public function getByCountryAndProducts(string $countryCode, array $productIds): array;
}