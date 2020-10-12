<?php

namespace Shop\Domain;

class Country
{
    /**
     * @var string
     */
    private string $_code = '';

    /**
     * @var string
     */
    private string $_name = '';

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->_code;
    }

    /**
     * @param string $_code
     */
    public function setCode(string $_code)
    {
        $this->_code = $_code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * @param string $_name
     */
    public function setName(string $_name)
    {
        $this->_name = $_name;
    }
}