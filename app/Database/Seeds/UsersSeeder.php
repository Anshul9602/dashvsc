<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'          => 1,
                'mobile_number'=> '1234567890',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
                'last_active' => date('Y-m-d H:i:s'),
                'points'      => 0,
                'work_ex'     => 'fresher',
                'status'      => 'Enable',
            ],
            // Add more user records as needed
        ];

        // Insert the data
        $this->db->table('users')->insertBatch($data);
    }
}
