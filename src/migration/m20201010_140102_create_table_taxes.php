<?php

use Shop\Infra\Db\MySql\Migration\AbstractMigration;

class m20201010_140102_create_table_taxes extends AbstractMigration
{
    /**
     * @var string
     */
    private $table = 'taxes';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->connection->exec(<<<SQL
CREATE TABLE IF NOT EXISTS {$this->table} (
  country_code varchar(2) NOT NULL,
  product_id INT NOT NULL,
  percent INT NOT NULL,
  PRIMARY KEY(country_code,product_id)
)
SQL
        );
        $data = [];
        $countryCodes = $this->getCountryCodes();
        $productIds = $this->getProductIds();
        foreach ($countryCodes as $countryCode) {
            foreach ($productIds as $productId) {
                $data[] = [
                    'country_code' => $countryCode,
                    'product_id' => $productId,
                    'percent' => random_int(10,20),
                ];
            }
        }
        $this->insertMany($this->table, $data);
    }

    /**
     * @return string[]
     * @throws Exception
     */
    private function getCountryCodes(): array
    {
        $query = $this->connection->prepare("SELECT code FROM countries");
        $query->execute();
        $values = [];
        while ($name = $query->fetchColumn()) {
            $values[] = $name;
        }
        return $values;
    }

    /**
     * @return int[]
     * @throws Exception
     */
    private function getProductIds(): array
    {
        $query = $this->connection->prepare("SELECT id FROM products");
        $query->execute();
        $values = [];
        while ($name = $query->fetchColumn()) {
            $values[] = $name;
        }
        return $values;
    }
}