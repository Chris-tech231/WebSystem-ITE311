<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route (homepage)
$routes->get('/', 'Home::index');

// About page
$routes->get('about', 'Home::about');

// Contact page
$routes->get('contact', 'Home::contact');

// Optional: Allow "/home" to work as well
$routes->get('home', 'Home::index');

$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::register');

// Normalize to lowercase routes
$routes->get('Login', 'Auth::login');
$routes->post('login', 'Auth::login');

$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'Auth::dashboard');

// Backward compatible uppercase aliases (avoid 404 when users hit /Register or /Login)
$routes->get('Register', 'Auth::register');
$routes->post('register', 'Auth::register');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');

use App\Controllers\Announcement;
use App\Controllers\Admin;
use App\Controllers\Teacher;
use App\Filters\RoleAuth;

// ... existing routes ...

// Announcements route
$routes->get('announcements', [Announcement::class, 'index']);

// ... we'll add more routes later for other tasks ...


