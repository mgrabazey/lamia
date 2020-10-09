<?php

use Shop\Infra\Container;
use Shop\Api\Transport\Http\Router;

require_once __DIR__.'/../../vendor/autoload.php';

$dbConfig = require_once __DIR__.'/../config/database.php';
$conn = new PDO(
    "mysql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['name']}",
    $dbConfig['user'],
    $dbConfig['pass']
);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$container = new Container($conn);

(new Router($container))->handle();