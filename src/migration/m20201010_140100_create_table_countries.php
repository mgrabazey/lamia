<?php

use Shop\Infra\Db\MySql\Migration\AbstractMigration;

class m20201010_140100_create_table_countries extends AbstractMigration
{
    /**
     * @var string
     */
    private $table = 'countries';

    /**
     * @var string[]
     */
    private $data = [
        ['code' => 'fi', 'name' => 'Finland'],
        ['code' => 'pl', 'name' => 'Poland'],
        ['code' => 'ua', 'name' => 'Ukraine'],
    ];

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->connection->exec(<<<SQL
CREATE TABLE IF NOT EXISTS {$this->table} (
  code varchar(2) NOT NULL PRIMARY KEY,
  name varchar(255) NOT NULL
)
SQL
        );
        $this->insertMany($this->table, $this->data);
    }
}