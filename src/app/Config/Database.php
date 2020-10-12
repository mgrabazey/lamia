<?php

namespace Shop\Config;

class Database extends AbstractConfig
{
    /**
     * @var string
     */
    public string $driver = 'mysql';

    /**
     * @var string
     */
    public string $host = 'db';

    /**
     * @var int
     */
    public int $post = 3306;

    /**
     * @var string
     */
    public string $name = 'shop';

    /**
     * @var string
     */
    public string $user = 'shop';

    /**
     * @var string
     */
    public string $pass = 'shop';
}