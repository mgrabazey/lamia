<?php

namespace Shop\Infra\Db\MySql\Migration;

use PDO;

abstract class AbstractMigration
{
    /**
     * @var PDO
     */
    protected $connection;

    /**
     * AbstractMigration constructor.
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Up migration.
     */
    abstract public function up();

    /**
     * Down migration.
     */
    abstract public function down();
}