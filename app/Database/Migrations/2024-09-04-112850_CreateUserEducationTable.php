<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserEducationTable extends Migration
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
            'ten_th' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'ten_school' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'ten_year' => [
                'type'       => 'YEAR',
                'null'       => true,
            ],
            'to_th' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'to_th_school' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'to_th_year' => [
                'type'       => 'YEAR',
                'null'       => true,
            ],
            'gra_dip' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'gr_degree' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'gr_university' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'gr_year' => [
                'type'       => 'YEAR',
                'null'       => true,
            ],
            'post_gra' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'pg_degree' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'pg_university' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'pg_year' => [
                'type'       => 'YEAR',
                'null'       => true,
            ],
            'doc' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'doc_degree' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'doc_university' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'doc_year' => [
                'type'       => 'YEAR',
                'null'       => true,
            ],
            'hotel_de' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'h_college' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'h_year' => [
                'type'       => 'YEAR',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        // Set primary key
        $this->forge->addKey('id', true);

        // Add foreign key constraint to 'user_id'
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        // Create the table
        $this->forge->createTable('user_education');
    }

    public function down()
    {
        // Drop the table if it exists
        $this->forge->dropTable('user_education');
    }
}
