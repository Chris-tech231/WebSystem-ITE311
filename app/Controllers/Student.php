<?php

namespace App\Controllers;

class Student extends BaseController
{
    public function dashboard()
    {
        $data = [
            'title' => 'Student Dashboard'
        ];
        return view('student_dashboard', $data);
    }
}