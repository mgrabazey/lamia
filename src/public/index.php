<?php

use Shop\Infra\Container;
use Shop\Api\Transport\Http\Router;

require_once __DIR__.'/../../vendor/autoload.php';

$pdo = require_once __DIR__.'/../bootstrap/database.php';
$mailer = require_once __DIR__.'/../bootstrap/mailer.php';

$container = new Container($pdo, $mailer);

(new Router($container))->handle();