<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Check if user is logged in
        if (!$session->get('logged_in')) {
            session()->setFlashdata('error', 'Please login to access this page.');
            return redirect()->to('/login');
        }

        $userRole = $session->get('role');
        $currentURI = $request->getUri()->getPath();

        // Define role-based permissions
        $permissions = [
            'student' => ['/announcements', '/student'],
            'teacher' => ['/announcements', '/teacher'],
            'admin' => ['/announcements', '/teacher', '/admin', '/student']
        ];

        // Check if user role exists in permissions
        if (!array_key_exists($userRole, $permissions)) {
            session()->setFlashdata('error', 'Invalid user role detected.');
            return redirect()->to('/announcements');
        }

        // Check if user has permission for current route
        $hasPermission = false;
        foreach ($permissions[$userRole] as $allowedPath) {
            if (strpos($currentURI, $allowedPath) === 0) {
                $hasPermission = true;
                break;
            }
        }

        // Allow access to logout and login routes for all authenticated users
        if (in_array($currentURI, ['/logout', '/login'])) {
            $hasPermission = true;
        }

        if (!$hasPermission) {
            session()->setFlashdata('error', 'Access Denied: Insufficient Permissions. You cannot access this page.');
            
            // Redirect based on user role for better UX
            switch ($userRole) {
                case 'admin':
                    return redirect()->to('/admin/dashboard');
                case 'teacher':
                    return redirect()->to('/teacher/dashboard');
                case 'student':
                default:
                    return redirect()->to('/announcements');
            }
        }

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // You can add post-processing logic here if needed
        // For example: logging, response modification, etc.
        
        return $response;
    }
}