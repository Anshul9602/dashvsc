<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJobPrefUserTable extends Migration
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
            'job_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'department' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'sub_dep' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'pref_state' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'pref_city' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'salery' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
            ],
            'start_time' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'end_time' => [
                'type' => 'TIME',
                'null' => true,
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
        $this->forge->createTable('job_pref_user');
    }

    public function down()
    {
        // Drop the table if it exists
        $this->forge->dropTable('job_pref_user');
    }
}
