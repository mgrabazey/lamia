<?php

namespace Shop\Api\Transport\Http\Controller;

use Shop\Api\Protocol\Json\ProductsResponse;
use Shop\Api\Transport\Http\Request;
use Shop\App\ContainerInterface;
use Shop\App\Module\Product\Service;

class ProductController
{
    /**
     * @param ContainerInterface $container
     * @param Request $request
     */
    public static function search(ContainerInterface $container, Request $request)
    {
        $products = Service::instance($container)->search($request->var('country_code'));
        echo json_encode(new ProductsResponse(...$products));
    }
}