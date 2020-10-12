<?php

namespace Shop\Api\Transport\Http;

use Throwable;
use Shop\Api\Transport\Http\Controller\CountryController;
use Shop\Api\Transport\Http\Controller\OrderController;
use Shop\Api\Transport\Http\Controller\ProductController;
use Shop\App\ContainerInterface;

class Router
{
    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    private array $routes = [
        'GET:api/v1/countries' => [CountryController::class, 'search'],
        'GET:api/v1/products/{country_code}' => [ProductController::class, 'search'],
        'POST:api/v1/orders' => [OrderController::class, 'create'],
    ];

    /**
     * Router constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @throws Throwable
     */
    public function handle()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');

        $inParts = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        foreach ($this->routes as $pattern => $handler) {
            list($method, $pattern) = explode(':', $pattern, 2);
            if ($method !== $_SERVER['REQUEST_METHOD']) {
                continue;
            }
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
            try {
                call_user_func($handler, $this->container, $request);
            } catch (Throwable $e) {
                http_response_code(500);
                throw $e;
            }
            return;
        }
        http_response_code(404);
    }
}