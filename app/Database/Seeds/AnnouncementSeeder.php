<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Welcome to New Academic Year',
                'content' => 'We are excited to welcome all students and staff to the new academic year. Classes will begin on January 15, 2024.',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Library Opening Hours Update',
                'content' => 'The university library will now be open until 10 PM on weekdays to better serve our students.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
            [
                'title' => 'Important: Registration Deadline',
                'content' => 'This is a reminder that the course registration deadline is January 20, 2024. Please complete your registrations before this date.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ]
        ];

        $this->db->table('announcements')->insertBatch($data);
    }
}