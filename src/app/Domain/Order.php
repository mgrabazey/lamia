<?php

namespace Shop\Domain;

use Shop\Domain\Observer\Order\OrderInterface;

class Order
{
    /**
     * @var OrderInterface[]
     */
    private array $onCreateObservers = [];

    /**
     * @var int
     */
    private int $_id = 0;

    /**
     * @var string
     */
    private string $_countryCode = '';

    /**
     * @var int
     */
    private int $_invoiceFormat = 0;

    /**
     * @var bool
     */
    private bool $_sendToEmail = false;

    /**
     * @var string|null
     */
    private ?string $_email = null;

    /**
     * @var float
     */
    private float $_price = 0;

    /**
     * @param OrderInterface $observer
     */
    public function attachOnCreate(OrderInterface $observer)
    {
        $this->onCreateObservers[] = $observer;
    }

    /**
     * Notify On Create.
     */
    public function notifyOnCreate()
    {
        foreach ($this->onCreateObservers as $observer) {
            $observer->update($this);
        }
    }

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
    public function getInvoiceFormat(): int
    {
        return $this->_invoiceFormat;
    }

    /**
     * @param int $_invoiceFormat
     */
    public function setInvoiceFormat(int $_invoiceFormat)
    {
        $this->_invoiceFormat = $_invoiceFormat;
    }

    /**
     * @return bool
     */
    public function getSendToEmail(): bool
    {
        return $this->_sendToEmail;
    }

    /**
     * @param bool $_sendToEmail
     */
    public function setSendToEmail(bool $_sendToEmail)
    {
        $this->_sendToEmail = $_sendToEmail;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->_email;
    }

    /**
     * @param string|null $_email
     */
    public function setEmail(?string $_email)
    {
        $this->_email = $_email;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->_price;
    }

    /**
     * @param float $_price
     */
    public function setPrice(float $_price)
    {
        $this->_price = round($_price, 2);
    }
}