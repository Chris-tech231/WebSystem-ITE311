<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password', 'role', 'name'];
    
    protected $validationRules = [
        'email' => 'required|valid_email',
        'password' => 'required|min_length[6]'
    ];
}