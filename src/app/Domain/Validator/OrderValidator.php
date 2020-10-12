<?php

namespace Shop\Domain\Validator;

use Shop\Domain\Enum\InvoiceFormat;
use Shop\Domain\Order;

class OrderValidator
{
    /**
     * @param Order $order
     * @return string[]
     */
    public static function validate(Order $order): array
    {
        $errors = [];
        if ($order->getSendToEmail() && !filter_var($order->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'No email or invalid.';
        }
        if (!in_array($order->getInvoiceFormat(), InvoiceFormat::values())) {
            $errors[] = 'Invalid invoice format.';
        }
        if (!$order->getProducts()) {
            $errors[] = 'No products selected.';
        }
        return $errors;
    }
}