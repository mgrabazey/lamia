<?php

namespace Shop\Domain;

class Tax
{
    /**
     * @var string
     */
    private string $_countryCode = '';

    /**
     * @var int
     */
    private int $_productId = 0;

    /**
     * @var float
     */
    private float $_value = 0;

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->_countryCode;
    }

    /**
     * @param string $_countryCode
     */
    public function setCountryCode(string $_countryCode)
    {
        $this->_countryCode = $_countryCode;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->_productId;
    }

    /**
     * @param int $_productId
     */
    public function setProductId(int $_productId)
    {
        $this->_productId = $_productId;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->_value;
    }

    /**
     * @param float $_value
     */
    public function setValue(float $_value)
    {
        $this->_value = $_value;
    }
}