<?php

use Core\Services\Contracts\Database;
use Core\Services\Contracts\Migration;

/**
 * Migration Class
 */
class CreateTestTable implements Migration
{
    /**
     * @inheritdoc
     */
    public function up(Database $db)
    {
        $db->schema()->createTable('test', [
            'id'      => ['type' => 'identity'],
            'string1' => ['type' => 'string'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down(Database $db)
    {
        $db->schema()->dropTable('test');
    }
}