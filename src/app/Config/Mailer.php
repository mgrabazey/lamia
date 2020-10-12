<?php

namespace Shop\Config;

class Mailer extends AbstractConfig
{
    /**
     * @var string
     */
    public string $host = 'smtp.gmail.com';

    /**
     * @var string
     */
    public string $user = 'mgrabazey@gmail.com';

    /**
     * @var string
     */
    public string $pass = 'Deserteagle860';

    /**
     * @var int
     */
    public int $port = 587;
}