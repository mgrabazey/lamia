<?php

namespace Shop\Api\Transport\Http\Controller;

use Shop\Api\Transport\Http\Request;
use Shop\App\ContainerInterface;
use Shop\App\Module\Country\Service;

class CountryController
{
    public static function search(ContainerInterface $container, Request $request)
    {
        $data = Service::instance($container)->search();
        print_r($data);
    }

    public static function get(ContainerInterface $container, Request $request)
    {
        $data = Service::instance($container)->get($request->var('id'));
        print_r($data);
    }
}