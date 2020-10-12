<?php

namespace Shop\Api\Transport\Http\Controller;

use Shop\Api\Protocol\Json\CountriesResponse;
use Shop\Api\Transport\Http\Request;
use Shop\App\ContainerInterface;
use Shop\App\Module\Country\Service;

class CountryController
{
    /**
     * @param ContainerInterface $container
     * @param Request $request
     */
    public static function search(ContainerInterface $container, Request $request)
    {
        $countries = Service::instance($container)->search();
        echo json_encode(new CountriesResponse(...$countries));
    }
}