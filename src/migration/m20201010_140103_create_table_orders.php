<?php

use Shop\Infra\Db\MySql\Migration\AbstractMigration;

class m20201010_140103_create_table_orders extends AbstractMigration
{
    /**
     * @var string
     */
    private $table = 'orders';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->connection->exec(<<<SQL
CREATE TABLE IF NOT EXISTS {$this->table} (
  id INT AUTO_INCREMENT PRIMARY KEY,
  country_code varchar(2) NOT NULL,
  email varchar(255),
  total_price INT NOT NULL
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