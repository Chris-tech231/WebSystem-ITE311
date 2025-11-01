<?php

namespace App\Controllers;

use App\Models\AnnouncementModel;

class Teacher extends BaseController
{
    public function index()
    {
        $model = new AnnouncementModel();
        $data['announcements'] = $model->findAll();

        return view('teacher_dashboard', $data);
    }

    public function create()
    {
        return view('teacher_create_announcement');
    }

    public function store()
    {
        $model = new AnnouncementModel();

        $model->save([
            'title' => $this->request->getPost('title'),
            'body'  => $this->request->getPost('body'),
        ]);

        return redirect()->to('/teacher');
    }
}
