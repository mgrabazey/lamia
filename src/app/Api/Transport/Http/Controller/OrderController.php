<?php

namespace Shop\Api\Transport\Http\Controller;

use Throwable;
use JsonException;
use Shop\Api\Protocol\Json\CreateOrder;
use Shop\Api\Transport\Http\Request;
use Shop\App\ContainerInterface;
use Shop\App\Module\Order\Service;

class OrderController
{
    /**
     * @param ContainerInterface $container
     * @param Request $request
     * @throws JsonException
     * @throws Throwable
     */
    public function create(ContainerInterface $container, Request $request)
    {
        $protocol = CreateOrder::create($request->raw());
        Service::instance($container)->create($protocol->order(), ...$protocol->orderProducts());
    }
}