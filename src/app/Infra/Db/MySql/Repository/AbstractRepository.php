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
    protected PDO $connection;

    /**
     * @var string
     */
    protected string $primaryKey = 'id';

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
        return $this->prepareAndFetchAll("SELECT * FROM {$this->table()}");
    }

    /**
     * @param $primaryKey
     * @return mixed
     */
    protected function fetchByPrimaryKey($primaryKey)
    {
        return $this->prepareAndFetchOne("SELECT * FROM {$this->table()} WHERE {$this->primaryKey} = :pk", [':pk' => $primaryKey]);
    }

    /**
     * @param array $primaryKeys
     * @return mixed
     */
    protected function fetchByPrimaryKeys(array $primaryKeys)
    {
        $params = [];
        foreach ($primaryKeys as $i => $primaryKey) {
            $params[":pk$i"] = $primaryKey;
        }
        $in = implode(',', array_keys($params));
        return $this->prepareAndFetchAll("SELECT * FROM {$this->table()} WHERE {$this->primaryKey} IN ({$in})", $params);
    }

    /**
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    protected function prepareAndFetchOne(string $sql, array $params = [])
    {
        $query = $this->connection->prepare($sql);
        $query->execute($params);
        $data = $query->fetch();
        $model = $this->model();
        $this->fromAttributes($model, $data);
        return $model;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return array
     */
    protected function prepareAndFetchAll(string $sql, array $params = [])
    {
        $query = $this->connection->prepare($sql);
        $query->execute($params);
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
                $name = '_' . lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $name))));
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
            $attribute = $refProperty->getName();
            if ($attribute[0] !== '_') {
                continue;
            }
            $attribute = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', substr($attribute, 1)));
            $value = $refProperty->getValue($model);
            if ($this->primaryKey === $attribute && is_null($value)) {
                continue;
            }
            $attributes[$attribute] = $value;
            if (is_null($params)) {
                continue;
            }
            $params[':'.$attribute] = is_bool($value) ? (int)$value : $value;
        }
        return $attributes;
    }
}