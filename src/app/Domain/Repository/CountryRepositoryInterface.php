<?php

namespace Shop\Domain\Repository;

use Shop\Domain\Country;

interface CountryRepositoryInterface
{
    /**
     * @return Country[]
     */
    public function search(): array;

    /**
     * @param string $code
     * @return Country
     */
    public function get(string $code): Country;
}