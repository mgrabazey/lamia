<?php

namespace Shop\Domain;

class Product
{
    /**
     * @var int
     */
    private int $_id = 0;

    /**
     * @var string
     */
    private string $_name = '';

    /**
     * @var string
     */
    private string $_description = '';

    /**
     * @var float
     */
    private float $_price = 0;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * @param int $_id
     */
    public function setId(int $_id)
    {
        $this->_id = $_id;
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

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->_description;
    }

    /**
     * @param string $_description
     */
    public function setDescription(string $_description)
    {
        $this->_description = $_description;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->_price;
    }

    /**
     * @param float $_price
     */
    public function setPrice(float $_price)
    {
        $this->_price = $_price;
    }
}