<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'  => 'Admin User',
                'email' => 'admin@example.com',
                'role'  => 'admin',
            ],
            [
                'name'  => 'Instructor One',
                'email' => 'instructor1@example.com',
                'role'  => 'instructor',
            ],
            [
                'name'  => 'Student One',
                'email' => 'student1@example.com',
                'role'  => 'student',
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
