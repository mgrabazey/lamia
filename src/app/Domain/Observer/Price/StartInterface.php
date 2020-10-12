<?php

namespace Shop\Domain\Observer\Price;

interface StartInterface
{
    /**
     * @param string $countryCode
     * @param StartProduct ...$products
     */
    public function update(string $countryCode, StartProduct ...$products);
}