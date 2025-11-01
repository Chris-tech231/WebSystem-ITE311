<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url']);
    }

    public function login()
    {
        // If user is already logged in, redirect based on role
        if (session()->get('logged_in')) {
            return $this->redirectBasedOnRole(session()->get('role'));
        }

        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // Validation
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $user = $this->userModel->where('email', $email)->first();

            if ($user && password_verify($password, $user['password'])) {
                $session = session();
                $session->set([
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'name' => $user['name'] ?? $user['email'],
                    'logged_in' => true
                ]);

                // ✅ TASK 3: Role-based redirection
                return $this->redirectBasedOnRole($user['role']);

            } else {
                return redirect()->back()->withInput()->with('error', 'Invalid email or password');
            }
        }

        $data = [
            'title' => 'Login - Student Portal'
        ];
        return view('auth/login', $data);
    }

    /**
     * Redirect user based on their role
     */
    private function redirectBasedOnRole($role)
    {
        switch ($role) {
            case 'admin':
                return redirect()->to('/admin/dashboard');
            case 'teacher':
                return redirect()->to('/teacher/dashboard');
            case 'student':
            default:
                return redirect()->to('/announcements');
        }
    }

    public function logout()
    {
        $session = session();
        $sessionData = [
            'user_id' => $session->get('user_id'),
            'email' => $session->get('email'),
            'role' => $session->get('role')
        ];
        
        session()->destroy();
        
        // Optional: Log logout activity
        // log_message('info', "User {$sessionData['email']} ({$sessionData['role']}) logged out");
        
        return redirect()->to('/login')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Registration method (if needed)
     */
    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'password_confirm' => 'required|matches[password]',
                'role' => 'required|in_list[student,teacher,admin]'
            ];

            if ($this->validate($rules)) {
                $userData = [
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'role' => $this->request->getPost('role'),
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $this->userModel->insert($userData);
                return redirect()->to('/login')->with('success', 'Registration successful! Please login.');
            } else {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        }

        $data = [
            'title' => 'Register - Student Portal'
        ];
        return view('auth/register', $data);
    }
}