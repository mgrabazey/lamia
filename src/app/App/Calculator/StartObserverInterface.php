<?php

namespace Shop\App\Calculator;

interface StartObserverInterface
{
    /**
     * @param string $countryCode
     * @param StartObserverProduct ...$products
     */
    public function update(string $countryCode, StartObserverProduct ...$products);
}