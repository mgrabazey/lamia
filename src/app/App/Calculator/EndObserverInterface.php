<?php

namespace Shop\App\Calculator;

interface EndObserverInterface
{
    /**
     * @param float $price
     */
    public function update(float &$price);
}