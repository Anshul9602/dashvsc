<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'        => 1,
                'email'     => 'admin@example.com',
                'password'  => password_hash('12345', PASSWORD_DEFAULT),
                'role'      => 'admin',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
                'deleted_at'=> null,
            ],
            [
                'id'        => 2,
                'email'     => 'admin@masterofjobs.com',
                'password'  => password_hash('Moj@2024', PASSWORD_DEFAULT),
                'role'      => 'admin',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
                'deleted_at'=> null,
            ],
            // Add more admin records as needed
        ];

        // Insert the data
        $this->db->table('admins')->insertBatch($data);
    }
}
