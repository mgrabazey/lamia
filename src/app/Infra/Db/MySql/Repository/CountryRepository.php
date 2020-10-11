<?php

namespace Shop\Infra\Db\MySql\Repository;

use Shop\Domain\Country;
use Shop\Domain\Repository\CountryInterface;
use Shop\Infra\Db\TableName;

class CountryRepository extends AbstractRepository implements CountryInterface
{
    /**
     * @inheritdoc
     */
    protected string $primaryKey = 'code';

    /**
     * @inheritdoc
     */
    protected function table(): string
    {
        return TableName::COUNTRY;
    }

    /**
     * @inheritdoc
     */
    protected function model(): object
    {
        return new Country();
    }

    /**
     * @inheritdoc
     */
    public function search(): array
    {
        return $this->fetchAll();
    }

    /**
     * @inheritdoc
     */
    public function get(string $code): Country
    {
        return $this->fetchByPrimaryKey($code);
    }
}