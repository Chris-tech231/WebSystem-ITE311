<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    /**
     * Register new users
     */
    public function register()
    {
        helper(['form']);
        $data = [];

        if ($this->request->is('post')) {
            $rules = [
                'name'             => 'required|min_length[3]|max_length[100]',
                'email'            => 'required|valid_email|is_unique[users.email]',
                'password'         => 'required|min_length[6]|max_length[255]',
                'password_confirm' => 'matches[password]'
            ];

            if ($this->validate($rules)) {
                $userModel = new UserModel();
                $userModel->save([
                    'name'     => $this->request->getVar('name'),
                    'email'    => $this->request->getVar('email'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'role'     => 'user'
                ]);

                // ✅ Success → write flashdata, then redirect to login
                session()->setFlashdata('success', 'Registration successful! You can now login.');
                return redirect()->to(site_url('login'));
            } else {
                // Validation failed → send errors to view
                $data['validation'] = $this->validator;
            }
        }

        return view('auth/Register', $data);
    }

    /**
     * Login users
     */
    public function login()
    {
        helper(['form']);
        $data = [];

        if ($this->request->is('post')) {
            $rules = [
                'email'    => 'required|valid_email',
                'password' => 'required|min_length[6]|max_length[255]'
            ];

            if ($this->validate($rules)) {
                $userModel = new UserModel();
                $user = $userModel->where('email', $this->request->getVar('email'))->first();

                if ($user && password_verify($this->request->getVar('password'), $user['password'])) {
                    // ✅ Create session
                    $session = session();
                    $session->set([
                        'id'         => $user['id'],
                        'name'       => $user['name'],
                        'email'      => $user['email'],
                        'role'       => $user['role'],
                        'isLoggedIn' => true,
                    ]);

                    return redirect()
                        ->to(base_url('dashboard'))
                        ->with('success', 'Welcome back, ' . $user['name'] . '!');
                } else {
                    //  Invalid credentials
                    return redirect()
                        ->to(base_url('login'))
                        ->with('error', 'Invalid login credentials.');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('auth/Login', $data);
    }

    /**
     * Protected dashboard
     */
    public function dashboard()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()
                ->to(base_url('login'))
                ->with('error', 'Please login first.');
        }

        return view('auth/Dashboard');
    }

    /**
     * Logout user
     */
    public function logout()
    {
        session()->destroy();
        return redirect()
            ->to(base_url('/login'))
            ->with('success', 'You have successfully logged out.');
    }
}
