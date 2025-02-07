<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'mobile_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'last_active' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'points' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'work_ex' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'default'    => 'Enable',
            ],
        ]);

        // Set primary key
        $this->forge->addKey('id', true);

        // Create the table
        $this->forge->createTable('users');
    }

    public function down()
    {
        // Drop the table if it exists
        $this->forge->dropTable('users');
    }
}
