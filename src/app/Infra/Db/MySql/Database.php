<?php

namespace Shop\Infra\Db\MySql;

use PDO;
use Shop\Domain\Service\DatabaseInterface;

class Database implements DatabaseInterface
{
    /**
     * @var PDO
     */
    protected PDO $connection;

    /**
     * Database constructor.
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @inheritdoc
     */
    public function beginTransaction()
    {
        return $this->connection->beginTransaction();
    }

    /**
     * @inheritdoc
     */
    public function commit()
    {
        return $this->connection->commit();
    }

    /**
     * @inheritdoc
     */
    public function rollBack()
    {
        return $this->connection->rollBack();
    }
}