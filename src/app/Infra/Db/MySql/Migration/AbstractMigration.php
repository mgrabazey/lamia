<?php

namespace Shop\Infra\Db\MySql\Migration;

use PDO;
use Exception;

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
     * @throws Exception
     */
    abstract public function up();

    /**
     * Down migration.
     * @throws Exception
     */
    abstract public function down();

    /**
     * @param string $table
     * @param array[] $data
     * @throws Exception
     */
    protected function insertMany(string $table, array $data)
    {
        foreach ($data as $i => $item) {
            $columns = [];
            $params = [];
            foreach ($item as $column => $value) {
                $columns[] = $column;
                $params[":{$column}{$i}"] = $value;
            }
            $query = $this->connection->prepare("INSERT INTO {$table} (".implode(',', $columns).") VALUES (" . implode(',', array_keys($params)) . ")");
            $query->execute($params);
        }
    }
}