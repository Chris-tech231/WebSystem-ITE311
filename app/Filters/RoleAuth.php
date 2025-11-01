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

        // Check if user has permission for current route
        $hasPermission = false;
        foreach ($permissions[$userRole] as $allowedPath) {
            if (strpos($currentURI, $allowedPath) === 0) {
                $hasPermission = true;
                break;
            }
        }

        if (!$hasPermission) {
            session()->setFlashdata('error', 'Access Denied: Insufficient Permissions');
            return redirect()->to('/announcements');
        }

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here after the response is sent
    }
}