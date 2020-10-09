<?php

use Shop\Infra\Db\MySql\Migration\AbstractMigration;

class m20201010_140104_create_table_orders_products extends AbstractMigration
{
    /**
     * @var string
     */
    private $table = 'orders_products';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->connection->exec(<<<SQL
CREATE TABLE IF NOT EXISTS {$this->table} (
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  PRIMARY KEY(order_id,product_id)
)
SQL
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->connection->exec('DROP TABLE {$this->table}');
    }
}