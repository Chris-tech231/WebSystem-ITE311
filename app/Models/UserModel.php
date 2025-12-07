<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'username', 'email', 'password', 'role', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'role' => 'required|in_list[student,teacher,admin]'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Name is required',
            'min_length' => 'Name must be at least 3 characters'
        ],
        'username' => [
            'required' => 'Username is required',
            'is_unique' => 'Username already exists'
        ],
        'email' => [
            'required' => 'Email is required',
            'valid_email' => 'Please provide a valid email',
            'is_unique' => 'Email already registered'
        ],
        'password' => [
            'required' => 'Password is required',
            'min_length' => 'Password must be at least 6 characters'
        ]
    ];
}