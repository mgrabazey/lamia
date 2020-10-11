<?php

namespace Shop\Api\Transport\Http;

use Shop\Api\Transport\Http\Controller\CountryController;
use Shop\Api\Transport\Http\Controller\OrderController;
use Shop\Api\Transport\Http\Tree\Group;
use Shop\Api\Transport\Http\Tree\Handler;
use Shop\App\ContainerInterface;

class Router
{
    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    // GET api/v1/countries
    // GET api/v1/countries/{id}
    // GET api/v1/taxes
    // GET api/v1/taxes/{countryCode}/{categoryId}
    // GET api/v1/categories
    // GET api/v1/categories/{id}
    // GET api/v1/products
    // GET api/v1/products/{id}
    // GET api/v1/orders
    // GET api/v1/orders/{id}
    // POST api/v1/orders
    private array $routes = [
        'countries' => [CountryController::class, 'search'],
        'countries/{id}' => [CountryController::class, 'get'],
        'orders' => [OrderController::class, 'create'],
    ];

//    private $group;

    /**
     * Router constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

//        $this->group = Group::instance('api/v1')->addGroup(
//            Group::instance('countries')->addHandler(
//                Handler::instance('GET', '', [CountryController::class, 'search']),
//                Handler::instance('GET', '{id}', [CountryController::class, 'get']),
//            )
//        );
    }

    /**
     * Handle.
     */
    public function handle()
    {
//        $inMethod = $_SERVER['REQUEST_METHOD'];
//        $inParts = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

        $inParts = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        foreach ($this->routes as $pattern => $handler) {
            $parts = explode('/', trim($pattern, '/'));
            if (count($inParts) !== count($parts)) {
                continue;
            }
            $request = new Request();
            foreach ($inParts as $k => $inPart) {
                $isVar = strlen($parts[$k]) >= 2 && $parts[$k][0] === '{' && $parts[$k][strlen($parts[$k])-1] === '}';
                if ($inPart !== $parts[$k] && !$isVar) {
                    continue(2);
                }
                if (!$isVar) {
                    continue;
                }
                $request->addVar(trim($parts[$k], '{}'), $inPart);
            }
            call_user_func($handler, $this->container, $request);
            return;
        }
        http_response_code(404);
    }
}