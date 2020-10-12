<?php

namespace Shop\App\Module\Order\Calculator;

use Shop\Domain\Observer\Price\EndInterface;

class FineIfSmall implements EndInterface
{
    /**
     * @inheritdoc
     */
    public function update(float &$price)
    {
        if ($price < 500) {
            $price += 50;
        }
    }
}