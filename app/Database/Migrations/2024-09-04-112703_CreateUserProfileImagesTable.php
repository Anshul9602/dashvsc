<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserProfileImagesTable extends Migration
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
            'image_path' => [
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

        // Add foreign key constraint to 'user_id'
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        // Create the table
        $this->forge->createTable('user_profile_images');
    }

    public function down()
    {
        // Drop the table if it exists
        $this->forge->dropTable('user_profile_images');
    }
}
