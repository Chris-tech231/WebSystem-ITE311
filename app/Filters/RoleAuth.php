<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userRole = session()->get('role');
        $currentURI = $request->getUri()->getPath();

        // Check access based on role
        switch ($userRole) {
            case 'admin':
                // Admin can access any route
                return true;
                
            case 'teacher':
                // Teacher can only access /teacher routes
                if (strpos($currentURI, 'teacher') === 0 || 
                    strpos($currentURI, '/teacher') === 0 ||
                    $currentURI === 'announcements') {
                    return true;
                }
                break;
                
            case 'student':
                // Student can access /student routes and announcements
                if (strpos($currentURI, 'student') === 0 || 
                    strpos($currentURI, '/student') === 0 ||
                    $currentURI === 'announcements') {
                    return true;
                }
                break;
        }

        // If no access granted, redirect with error message
        session()->setFlashdata('error', 'Access Denied: Insufficient Permissions');
        return redirect()->to('/announcements');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here after response is sent
    }
}