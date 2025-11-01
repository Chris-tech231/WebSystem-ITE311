<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (! $session->get('isLoggedIn')) {
            // not logged in
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        // If roles were passed as arguments, check them
        if (! empty($arguments)) {
            $allowed = (array) $arguments;
            $userRole = $session->get('role');
            if (! in_array($userRole, $allowed)) {
                // unauthorized
                return redirect()->to('/dashboard')->with('error', 'You are not allowed to access that page.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // no-op
    }
}
