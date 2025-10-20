<?php

namespace App\Controllers;

class Teacher extends BaseController
{
    public function dashboard()
    {
        $data = [
            'title' => 'Teacher Dashboard'
        ];
        return view('teacher_dashboard', $data);
    }
}