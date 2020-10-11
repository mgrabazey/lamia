<?php

namespace Shop\Domain;

class Order
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var string
     */
    private $email;

    /**
     * @var int
     */
    private $totalPrice;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode(string $countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(string $email = null)
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }

    /**
     * @param int $totalPrice
     */
    public function setTotalPrice(int $totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }
}