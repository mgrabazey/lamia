<?php

namespace Shop\Domain\Observer\Price;

interface EndInterface
{
    /**
     * @param float $price
     */
    public function update(float &$price);
}