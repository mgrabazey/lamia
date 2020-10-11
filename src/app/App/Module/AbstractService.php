<?php

namespace Shop\App\Module;

use Shop\App\ContainerInterface;

abstract class AbstractService
{
    /**
     * @var ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * @param ContainerInterface $container
     * @return static
     */
    public static function instance(ContainerInterface $container): self
    {
        return new static($container);
    }

    /**
     * AbstractService constructor.
     * @param ContainerInterface $container
     */
    private function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}