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
        // TODO move values to config
        if ($price < 200) {
            $price += 10;
        }
    }
}