<?php

namespace Shop\Config;

abstract class AbstractConfig
{
    /**
     * @var AbstractConfig[]
     */
    protected static array $instances;

    /**
     * @return static
     */
    public static function instance(): self
    {
        if (!isset(static::$instances[static::class])) {
            static::$instances[static::class] = new static();
        }
        return static::$instances[static::class];
    }
}