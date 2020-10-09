<?php

namespace Shop\Infra\Db\MySql\Repository;

use PDO;
use ReflectionObject;
use ReflectionException;

abstract class AbstractRepository
{
    /**
     * @var PDO
     */
    protected $connection;

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * AbstractRepository constructor.
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return object
     */
    abstract protected function model();

    /**
     * @return string
     */
    abstract protected function table(): string;

    /**
     * @return object[]
     */
    protected function fetchAll(): array
    {
        $query = $this->connection->prepare("SELECT * FROM {$this->table()}");
        $query->execute();
        $data = $query->fetchAll();
        $models = [];
        foreach ($data as $item) {
            $model = $this->model();
            $this->fillModel($model, $item);
            $models[] = $model;
        }
        return $models;
    }

    /**
     * @param $primaryKey
     * @return mixed
     */
    protected function fetchByPrimaryKey($primaryKey)
    {
        $query = $this->connection->prepare("SELECT * FROM {$this->table()} WHERE {$this->primaryKey} = :pk");
        $query->execute([':pk' => $primaryKey]);
        $data = $query->fetch();
        $model = $this->model();
        $this->fillModel($model, $data);
        return $model;
    }

    /**
     * @param $model
     * @param array $attributes
     */
    private function fillModel($model, array $attributes)
    {
        $refModel = new ReflectionObject($model);
        foreach ($attributes as $name => $value) {
            try {
                // by the doc property names are case insensitive
                $name = str_replace('_', ' ', $name);
                $refProperty = $refModel->getProperty($name);

            } catch (ReflectionException $e) {
                continue;
            }
            $refProperty->setAccessible(true);
            $refProperty->setValue($model, $value);
        }
    }
}