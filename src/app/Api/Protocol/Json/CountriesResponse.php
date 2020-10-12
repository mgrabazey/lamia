<?php

namespace Shop\Api\Protocol\Json;

use JsonSerializable;
use Shop\Domain\Country;

class CountriesResponse implements JsonSerializable
{
    /**
     * @var CountryResponse[]
     */
    private array $countries;

    /**
     * CountriesResponse constructor.
     * @param Country ...$countries
     */
    public function __construct(Country ...$countries)
    {
        $this->countries = array_map(fn(Country $country) => new CountryResponse($country), $countries);
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return $this->countries;
    }
}