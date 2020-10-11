<?php

use Shop\Infra\Db\MySql\Migration\AbstractMigration;

class m20201010_140103_create_table_orders extends AbstractMigration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->connection->exec(<<<SQL
CREATE TABLE IF NOT EXISTS orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  country_code VARCHAR(2) NOT NULL,
  invoice_format INT NOT NULL,
  send_to_email BOOLEAN NOT NULL,
  email VARCHAR(255),
  price FLOAT NOT NULL
)
SQL
        );
    }
}