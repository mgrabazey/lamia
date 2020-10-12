<?php

namespace Shop\Domain\Repository;

use Shop\Domain\Country;

interface CountryInterface
{
    /**
     * @return Country[]
     */
    public function search(): array;
}