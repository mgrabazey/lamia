<?php

namespace Shop\Domain;

class Order
{
    /**
     * @var int
     */
    private int $id = 0;

    /**
     * @var string
     */
    private string $countryCode = '';

    /**
     * @var int
     */
    private int $invoiceFormat = 0;

    /**
     * @var bool
     */
    private bool $sendToEmail = false;

    /**
     * @var string|null
     */
    private ?string $email = null;

    /**
     * @var float
     */
    private float $price = 0;

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
     * @return int
     */
    public function getInvoiceFormat(): int
    {
        return $this->invoiceFormat;
    }

    /**
     * @param int $invoiceFormat
     */
    public function setInvoiceFormat(int $invoiceFormat)
    {
        $this->invoiceFormat = $invoiceFormat;
    }

    /**
     * @return bool
     */
    public function getSendToEmail(): bool
    {
        return $this->sendToEmail;
    }

    /**
     * @param bool $sendToEmail
     */
    public function setSendToEmail(bool $sendToEmail)
    {
        $this->sendToEmail = $sendToEmail;
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
    public function setEmail(?string $email)
    {
        $this->email = $email;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = round($price, 2);
    }
}