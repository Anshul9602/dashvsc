<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJobPrefTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'department' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'sub_department' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        
        // Set primary key
        $this->forge->addKey('id', true);

        // Create the table
        $this->forge->createTable('job_pref');
    }

    public function down()
    {
        // Drop the table if it exists
        $this->forge->dropTable('job_pref');
    }
}
