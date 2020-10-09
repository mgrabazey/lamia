<?php

namespace Shop\Api\Transport\Http;

use Shop\App\ContainerInterface;
use Shop\App\Module\Country\Service;
use Shop\Infra\Container;

class CountryController
{
    public static function search(ContainerInterface $container, Request $request)
    {
        $conn = new \PDO('mysql:host=db;dbname=shop', 'shop', 'shop');
        $conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $data = Service::instance(
            new Container(
                $conn
            )
        )->search();
        print_r($data);
    }

    public static function get(ContainerInterface $container, Request $request)
    {
        $conn = new \PDO('mysql:host=db;dbname=shop', 'shop', 'shop');
        $conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $data = Service::instance(
            new Container(
                $conn
            )
        )->get($request->var('id'));
        print_r($data);
    }
}