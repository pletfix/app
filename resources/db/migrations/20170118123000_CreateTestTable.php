<?php

use App\Services\Contracts\Migration as MigrationContract;
use App\Services\PDOs\Schemas\Contracts\Schema;

/**
 * Migration Class
 */
class CreateTestTable implements MigrationContract
{
    /**
     * @inheritdoc
     */
    public function up(Schema $schema)
    {
        $schema->createTable('test', [
            'id'   => ['type' => 'identity'],
            'string1' => ['type' => 'string'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down(Schema $schema)
    {
        $schema->dropTable('test');
    }
}