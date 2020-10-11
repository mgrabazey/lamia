<?php

namespace Shop\Infra\Db\MySql\Repository;

use Shop\Domain\Repository\TaxInterface;
use Shop\Domain\Tax;
use Shop\Infra\Db\TableName;

class TaxRepository extends AbstractRepository implements TaxInterface
{
    /**
     * @inheritdoc
     */
    protected function table(): string
    {
        return TableName::TAX;
    }

    /**
     * @inheritdoc
     */
    protected function model(): object
    {
        return new Tax();
    }

    /**
     * @inheritdoc
     */
    public function getByCountryAndProducts(string $countryCode, array $productIds): array
    {
        $productParams = [];
        foreach ($productIds as $i => $productId) {
            $productParams[":id$i"] = $productId;
        }
        $in = implode(',', array_keys($productParams));
        return $this->prepareAndFetchAll(
            "SELECT * FROM {$this->table()} WHERE country_code = :code AND product_id IN ({$in})",
            array_merge([':code' => $countryCode], $productParams)
        );
    }
}