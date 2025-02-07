<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateResumesTable extends Migration
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
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'Resume' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        // Set primary key
        $this->forge->addKey('id', true);

        // Create the table
        $this->forge->createTable('resumes');
    }

    public function down()
    {
        // Drop the table if it exists
        $this->forge->dropTable('resumes');
    }
}
