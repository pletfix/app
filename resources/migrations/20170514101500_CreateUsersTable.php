<?php

use Core\Services\Contracts\Database;
use Core\Services\Contracts\Migration;

class CreateUsersTable implements Migration
{
    /**
     * @inheritdoc
     */
    public function up(Database $db)
    {
        $db->schema()->createTable('users', [
            'id'                 => ['type' => 'identity'],
            'name'               => ['type' => 'string'],
            'email'              => ['type' => 'string', 'nullable' => true],
            'password'           => ['type' => 'string', 'nullable' => true],
            'role'               => ['type' => 'string', 'nullable' => true],
            'principal'          => ['type' => 'string', 'nullable' => true],
            'confirmation_token' => ['type' => 'string', 'size' =>  60, 'nullable' => true],
            'remember_token'     => ['type' => 'string', 'size' => 100, 'nullable' => true],
//            'created_at'       => ['type' => 'timestamp'],
//            'updated_at'       => ['type' => 'timestamp'],
        ]);

        $db->schema()->addIndex('users', 'email',     ['unique'  => true]);
        $db->schema()->addIndex('users', 'principal', ['unique'  => true]);
    }

    /**
     * @inheritdoc
     */
    public function down(Database $db)
    {
        $db->schema()->dropTable('users');
    }
}