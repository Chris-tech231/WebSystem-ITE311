<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;

class Auth extends BaseController
{
    protected $db;
    protected $users;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->users = $this->db->table('users');
    }

    /**
     * REGISTER - Enhanced with proper role validation
     */
    public function register()
    {
        helper(['form']);
        $data = [];

        if ($this->request->is('post')) {
            $rules = [
                'name'              => 'required|min_length[3]|max_length[100]',
                'email'             => 'required|valid_email|is_unique[users.email]',
                'password'          => 'required|min_length[6]|max_length[255]',
                'password_confirm'  => 'required|matches[password]',
                'role'              => 'required|in_list[admin,teacher,student]'
            ];

            $validationMessages = [
                'name' => [
                    'required' => 'The name field is required.',
                    'min_length' => 'Name must be at least 3 characters long.',
                    'max_length' => 'Name cannot exceed 100 characters.'
                ],
                'email' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Please provide a valid email address.',
                    'is_unique' => 'This email is already registered.'
                ],
                'password' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must be at least 6 characters long.',
                    'max_length' => 'Password is too long.'
                ],
                'password_confirm' => [
                    'required' => 'Please confirm your password.',
                    'matches' => 'Passwords do not match.'
                ],
                'role' => [
                    'required' => 'Please select a role.',
                    'in_list' => 'Invalid role selected.'
                ]
            ];

            if ($this->validate($rules, $validationMessages)) {
                $newData = [
                    'name'       => trim($this->request->getPost('name')),
                    'email'      => trim($this->request->getPost('email')),
                    'password'   => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                    'role'       => $this->request->getPost('role'),
                    'status'     => 'active',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                try {
                    if ($this->users->insert($newData)) {
                        session()->setFlashdata('success', 'Registration successful! You can now log in.');
                        return redirect()->to(base_url('login'));
                    } else {
                        session()->setFlashdata('error', 'Registration failed. Please try again.');
                        return redirect()->back()->withInput();
                    }
                } catch (\Exception $e) {
                    log_message('error', 'Registration error: ' . $e->getMessage());
                    session()->setFlashdata('error', 'An error occurred during registration.');
                    return redirect()->back()->withInput();
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('auth/register', $data);
    }

    /**
     * LOGIN - Enhanced with security checks
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

            $validationMessages = [
                'email' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Please enter a valid email address.'
                ],
                'password' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must be at least 6 characters long.'
                ]
            ];

            if ($this->validate($rules, $validationMessages)) {
                $email = trim($this->request->getPost('email'));
                $password = $this->request->getPost('password');

                try {
                    $user = $this->users->where('email', $email)->get()->getRow();

                    if ($user && password_verify($password, $user->password)) {
                        // Check if user is restricted
                        if (isset($user->status) && $user->status === 'restricted') {
                            session()->setFlashdata('error', 'Your account has been restricted. Please contact support.');
                            return redirect()->back()->withInput();
                        }

                        // Store user data in session including role
                        $sessionData = [
                            'user_id'    => $user->id,
                            'user_name'  => $user->name,
                            'user_email' => $user->email,
                            'user_role'  => $user->role,
                            'isLoggedIn' => true,
                            'login_time' => time()
                        ];
                        session()->set($sessionData);

                        // Regenerate session ID for security
                        session()->regenerate();

                        // Log successful login
                        log_message('info', "User logged in: {$user->email} (ID: {$user->id})");

                        // Redirect all users to unified dashboard
                        return redirect()->to(base_url('dashboard'));
                    } else {
                        session()->setFlashdata('error', 'Invalid email or password.');
                        return redirect()->back()->withInput();
                    }
                } catch (\Exception $e) {
                    log_message('error', 'Login error: ' . $e->getMessage());
                    session()->setFlashdata('error', 'An error occurred during login.');
                    return redirect()->back()->withInput();
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('auth/login', $data);
    }

    /**
     * DASHBOARD - Enhanced with role-based content
     */
    public function dashboard()
    {
        // Authorization check - ensure user is logged in
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Please login to access the dashboard.');
            return redirect()->to(base_url('login'));
        }

        // Get user role and info from session
        $role = session()->get('user_role');
        $userName = session()->get('user_name');
        $userEmail = session()->get('user_email');

        // Prepare base data
        $data = [
            'username' => $userName,
            'email' => $userEmail,
            'role' => $role
        ];

        try {
            // Fetch role-specific data from database
            switch ($role) {
                case 'admin':
                    $data = array_merge($data, $this->getAdminDashboardData());
                    break;

                case 'teacher':
                    $data = array_merge($data, $this->getTeacherDashboardData());
                    break;

                case 'student':
                    $data = array_merge($data, $this->getStudentDashboardData());
                    break;

                default:
                    session()->setFlashdata('error', 'Invalid user role.');
                    return redirect()->to(base_url('login'));
            }
        } catch (\Exception $e) {
            log_message('error', 'Dashboard error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error loading dashboard data.');
        }

        return view('auth/dashboard', $data);
    }

    /**
     * Get Admin Dashboard Data
     */
    private function getAdminDashboardData()
    {
        return [
            'title' => "Admin Dashboard",
            'description' => "Manage system, users, and courses",
            'total_users' => $this->users->countAll(),
            'total_students' => $this->users->where('role', 'student')->countAllResults(false),
            'total_teachers' => $this->users->where('role', 'teacher')->countAllResults(false),
            'total_admins' => $this->users->where('role', 'admin')->countAllResults(false),
            'recent_users' => $this->users
                ->select('id, name, email, role, status, created_at')
                ->orderBy('id', 'DESC')
                ->limit(5)
                ->get()
                ->getResultArray()
        ];
    }

    /**
     * Get Teacher Dashboard Data
     */
    private function getTeacherDashboardData()
    {
        return [
            'title' => "Teacher Dashboard",
            'description' => "Create content, manage grades, and track student progress",
            'total_courses' => 0,
            'total_students' => 0,
            'pending_assignments' => 0,
            'graded_assignments' => 0
        ];
    }

    /**
     * Get Student Dashboard Data
     */
    private function getStudentDashboardData()
    {
        return [
            'title' => "Student Dashboard",
            'description' => "View courses, submit work, and track your progress",
            'enrolled_courses' => 0,
            'pending_assignments' => 0,
            'completed_assignments' => 0,
            'average_grade' => 0
        ];
    }

    /**
     * PROFILE - View and edit user profile
     */
    public function profile()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Please login to access your profile.');
            return redirect()->to(base_url('login'));
        }

        helper(['form']);
        $data = [];

        $userId = session()->get('user_id');
        $user = $this->users->where('id', $userId)->get()->getRow();

        if (!$user) {
            session()->setFlashdata('error', 'User not found.');
            return redirect()->to(base_url('dashboard'));
        }

        // Handle profile update (POST request)
        if ($this->request->is('post')) {
            $rules = [
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => "required|valid_email|is_unique[users.email,id,{$userId}]"
            ];

            // If password is being updated
            if ($this->request->getPost('password')) {
                $rules['password'] = 'min_length[6]|max_length[255]';
                $rules['password_confirm'] = 'matches[password]';
            }

            $validationMessages = [
                'name' => [
                    'required' => 'Name is required.',
                    'min_length' => 'Name must be at least 3 characters long.',
                    'max_length' => 'Name cannot exceed 100 characters.'
                ],
                'email' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Please provide a valid email address.',
                    'is_unique' => 'This email is already in use by another account.'
                ],
                'password' => [
                    'min_length' => 'Password must be at least 6 characters long.',
                    'max_length' => 'Password is too long.'
                ],
                'password_confirm' => [
                    'matches' => 'Passwords do not match.'
                ]
            ];

            if ($this->validate($rules, $validationMessages)) {
                $updateData = [
                    'name' => trim($this->request->getPost('name')),
                    'email' => trim($this->request->getPost('email')),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                // Update password if provided
                if ($this->request->getPost('password')) {
                    $updateData['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
                }

                try {
                    if ($this->users->where('id', $userId)->update(null, $updateData)) {
                        // Update session data with new information
                        session()->set([
                            'user_name' => $updateData['name'],
                            'user_email' => $updateData['email']
                        ]);

                        log_message('info', "Profile updated: User ID {$userId}");

                        session()->setFlashdata('success', 'Profile updated successfully!');
                        return redirect()->to(base_url('profile'));
                    } else {
                        session()->setFlashdata('error', 'Failed to update profile. Please try again.');
                    }
                } catch (\Exception $e) {
                    log_message('error', 'Profile update error: ' . $e->getMessage());
                    session()->setFlashdata('error', 'An error occurred while updating your profile.');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        $data['user'] = $user;
        $data['title'] = 'My Profile';

        return view('auth/profile', $data);
    }

    /**
     * LOGOUT - Destroy session securely
     */
    public function logout()
    {
        // Get user info before destroying session
        $userName = session()->get('user_name');
        $userId = session()->get('user_id');

        // Log logout event
        if ($userId) {
            log_message('info', "User logged out: {$userName} (ID: {$userId})");
        }

        // Destroy the session
        session()->destroy();

        // Set success message and redirect
        session()->setFlashdata('success', 'You have been logged out successfully.');
        return redirect()->to(base_url('login'));
    }

    /**
     * Check if user has specific role(s)
     */
    private function checkRole($allowedRoles = [])
    {
        if (!session()->get('isLoggedIn')) {
            return false;
        }

        $userRole = session()->get('user_role');
        
        if (empty($allowedRoles)) {
            return true;
        }

        return in_array($userRole, $allowedRoles);
    }

    /**
     * Authorize access based on role
     */
    protected function authorize($allowedRoles = [])
    {
        if (!$this->checkRole($allowedRoles)) {
            session()->setFlashdata('error', 'Access denied. You do not have permission to access this page.');
            return redirect()->to(base_url('dashboard'));
        }
    }

    /**
     * Check if user is logged in
     */
    protected function isLoggedIn()
    {
        return session()->get('isLoggedIn') === true;
    }

    /**
     * Get current user role
     */
    protected function getCurrentRole()
    {
        return session()->get('user_role');
    }

    /**
     * Get current user ID
     */
    protected function getCurrentUserId()
    {
        return session()->get('user_id');
    }
}