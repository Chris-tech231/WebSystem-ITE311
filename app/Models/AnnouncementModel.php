<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnouncementModel extends Model
{
    protected $table = 'announcements';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'content', 'created_at'];
    protected $useTimestamps = false;
    
    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'content' => 'required|min_length[10]'
    ];
    
    protected $validationMessages = [
        'title' => [
            'required' => 'Announcement title is required.',
            'min_length' => 'Title must be at least 3 characters long.'
        ],
        'content' => [
            'required' => 'Announcement content is required.',
            'min_length' => 'Content must be at least 10 characters long.'
        ]
    ];
}