 <?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // Example session data
        $data = [
            'name' => session()->get('name') ?? 'Guest',
            'role' => session()->get('role') ?? 'Visitor',
        ];

        return view('Dashboard', $data);
    }
}
