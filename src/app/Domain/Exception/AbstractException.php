<?php

namespace Shop\Domain\Exception;

use Exception;
use Throwable;

abstract class AbstractException extends Exception
{
    /**
     * @var mixed
     */
    private $data;

    public function __construct($data, Throwable $previous = null)
    {
        $this->data = $data;
        parent::__construct(var_export($data, true), 0, $previous);
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}