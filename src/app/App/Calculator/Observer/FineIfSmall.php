<?php


namespace Shop\App\Calculator\Observer;

use Shop\App\Calculator\EndObserverInterface;

class FineIfSmall implements EndObserverInterface
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