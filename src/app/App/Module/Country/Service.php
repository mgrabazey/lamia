<?php

namespace Shop\App\Module\Country;

use Shop\App\Module\AbstractService;
use Shop\Domain\Country;

class Service extends AbstractService
{
    /**
     * @return Country[]
     */
    public function search(): array
    {
        return $this->container->countryRepository()->search();
    }
}