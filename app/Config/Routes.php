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

$routes->get('/announcements', 'Announcements::index');

$routes->get('announcements', 'Announcements::index');

// Protected routes with RoleAuth filter
$routes->group('admin', ['filter' => 'roleauth'], function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
});

$routes->group('teacher', ['filter' => 'roleauth'], function($routes) {
    $routes->get('dashboard', 'Teacher::dashboard');
});

// You can add student routes here if needed in the future
$routes->group('student', ['filter' => 'roleauth'], function($routes) {
    // Add student-specific routes here
});