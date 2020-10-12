<?php

namespace Shop\Config;

abstract class AbstractConfig
{
    /**
     * @var self
     */
    protected static $instance;

    /**
     * @return static
     */
    public static function instance(): self
    {
        if (!static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}