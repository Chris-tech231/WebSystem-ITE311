<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $userModel = new UserModel();
            $user = $userModel->where('email', $email)->first();

            if ($user && password_verify($password, $user['password'])) {
                $session = session();
                $session->set([
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'logged_in' => true
                ]);

                // Role-based redirection
                switch ($user['role']) {
                    case 'admin':
                        return redirect()->to('/admin/dashboard');
                    case 'teacher':
                        return redirect()->to('/teacher/dashboard');
                    case 'student':
                    default:
                        return redirect()->to('/announcements');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid email or password');
            }
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}