<?php

namespace Shop\Api\Protocol\Json;

use JsonSerializable;
use Shop\Domain\Country;

class CountryResponse implements JsonSerializable
{
    /**
     * @var Country
     */
    private Country $country;

    /**
     * CountryResponse constructor.
     * @param Country $country
     */
    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return [
            'code' => $this->country->getCode(),
            'name' => $this->country->getName(),
        ];
    }
}