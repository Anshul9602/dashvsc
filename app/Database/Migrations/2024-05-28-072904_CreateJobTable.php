<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJobsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                      => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'hotelier_id'             => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'job_title'               => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'job_description'         => [
                'type'           => 'TEXT',
            ],
            'job_type'                => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'skill_requirements'      => [
                'type'           => 'TEXT',
            ],
            'location'                => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'department'              => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'experience_requirements' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'status'                  => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'created_at'              => [
                'type'           => 'TIMESTAMP',
                'null'           => true,
            ],
            'updated_at'              => [
                'type'           => 'TIMESTAMP',
                'null'           => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jobs');
    }

    public function down()
    {
        $this->forge->dropTable('jobs');
    }
}
