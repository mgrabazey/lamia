<?php

namespace Shop\Api\Transport\Http\Controller;

use Shop\Api\Protocol\Json\OrderResponse;
use Shop\Api\Protocol\Json\ProductsResponse;
use Throwable;
use JsonException;
use Shop\Api\Protocol\Json\CreateOrderRequest;
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
        $order = CreateOrderRequest::create($request->raw())->order();
        Service::instance($container)->create($order);
        echo json_encode(new OrderResponse($order));
    }
}