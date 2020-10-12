<?php

namespace Shop\Domain\Enum;

class InvoiceFormat
{
    const JSON = 1;
    const HTML = 2;

    /**
     * @return int[]
     */
    public static function values(): array
    {
        return [
            self::JSON,
            self::HTML,
        ];
    }
}