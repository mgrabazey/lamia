<?php

use Shop\Infra\Db\MySql\Migration\AbstractMigration;

class m20201010_140101_create_table_products extends AbstractMigration
{
    /**
     * @var string
     */
    private $table = 'products';

    /**
     * @var string[]
     */
    private $data = [
        ['name' => 'product1', 'description' => 'description of product1', 'price' => 20],
        ['name' => 'product2', 'description' => 'description of product2', 'price' => 30],
        ['name' => 'product3', 'description' => 'description of product3', 'price' => 25],
        ['name' => 'product4', 'description' => 'description of product4', 'price' => 35],
        ['name' => 'product5', 'description' => 'description of product5', 'price' => 20],
    ];

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->connection->exec(<<<SQL
CREATE TABLE IF NOT EXISTS {$this->table} (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name varchar(255) NOT NULL,
  description text,
  price INT NOT NULL
)
SQL
        );
        $this->insertMany($this->table, $this->data);
    }
}