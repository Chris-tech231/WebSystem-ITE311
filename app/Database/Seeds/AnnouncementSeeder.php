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
                'content' => 'We are excited to welcome all students to the new academic year 2024. Classes will begin on January 15th. Please check your schedules and be prepared for orientation week.',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Library System Upgrade',
                'content' => 'The university library will be undergoing a system upgrade this weekend. Services may be temporarily unavailable from Friday 8 PM to Sunday 6 AM. We apologize for any inconvenience.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
            [
                'title' => 'Scholarship Applications Open',
                'content' => 'Applications for the Merit Scholarship Program are now open. Eligible students can apply through the student portal until January 30th. Contact the financial aid office for more information.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))
            ]
        ];

        $this->db->table('announcements')->insertBatch($data);
    }
}