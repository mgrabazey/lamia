<?php

use Shop\Infra\Db\MySql\Migration\AbstractMigration;

class m20201010_140100_create_table_countries extends AbstractMigration
{
    /**
     * @var string
     */
    private string $table = 'countries';

    /**
     * @var string[]
     */
    private array $data = [
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
  code VARCHAR(2) NOT NULL PRIMARY KEY,
  name VARCHAR(255) NOT NULL
)
SQL
        );
        $this->insertMany($this->table, $this->data);
    }
}