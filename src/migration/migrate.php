<?php

use Shop\Infra\Db\MySql\Migration\Manager;

require_once __DIR__.'/../../vendor/autoload.php';

$dbConfig = require_once __DIR__.'/../config/database.php';
$conn = new PDO(
    "mysql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['name']}",
    $dbConfig['user'],
    $dbConfig['pass']
);
$conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

(new Manager($conn, __DIR__))->handle();
