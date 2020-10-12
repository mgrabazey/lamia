<?php

use Shop\Infra\Db\MySql\Migration\Manager;

require_once __DIR__.'/../../vendor/autoload.php';

$pdo = require_once __DIR__.'/../bootstrap/database.php';

(new Manager($pdo, __DIR__))->handle();
