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
            $this->fromAttributes($model, $item);
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
        $this->fromAttributes($model, $data);
        return $model;
    }

    /**
     * @param $model
     * @return int|string
     */
    protected function insert($model)
    {
        $params = [];
        $attributes = $this->toAttributes($model, $params);
        $columns = implode(',', array_keys($attributes));
        $values = implode(',', array_keys($params));
        $query = $this->connection->prepare("INSERT INTO {$this->table()} ({$columns}) VALUES ({$values})");
        $query->execute($params);
        return $this->connection->lastInsertId();
    }

    /**
     * @param $model
     * @param array $attributes
     */
    private function fromAttributes($model, array $attributes)
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

    /**
     * @param $model
     * @param array|null $params
     * @return array
     */
    private function toAttributes($model, array &$params = null): array
    {
        $refModel = new ReflectionObject($model);
        $attributes = [];
        foreach ($refModel->getProperties() as $refProperty) {
            $refProperty->setAccessible(true);
            $attribute = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $refProperty->getName()));
            $value = $refProperty->getValue($model);
            if ($this->primaryKey === $attribute && is_null($value)) {
                continue;
            }
            $attributes[$attribute] = $value;
            if (is_null($params)) {
                continue;
            }
            $params[':'.$attribute] = $value;
        }
        return $attributes;
    }
}