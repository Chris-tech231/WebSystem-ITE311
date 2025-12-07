<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home
$routes->get('/', 'Home::index');

// Authentication Routes
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::register');
$routes->get('/logout', 'Auth::logout');

// Dashboard Route (Unified for all roles)
$routes->get('/dashboard', 'Auth::dashboard');

// Profile Route (available to all authenticated users)
$routes->get('/profile', 'Auth::profile');
$routes->post('/profile', 'Auth::profile');

// Admin Routes (protected by auth and role filters)
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('users', 'Admin::users');
    $routes->get('courses', 'Admin::courses');
    $routes->get('settings', 'Admin::settings');
    $routes->get('reports', 'Admin::reports');
});

// Teacher Routes (protected by auth and role filters)
$routes->group('teacher', ['filter' => 'auth'], function($routes) {
    $routes->get('courses', 'Teacher::courses');
    $routes->get('students', 'Teacher::students');
    $routes->get('assignments', 'Teacher::assignments');
    $routes->get('grades', 'Teacher::grades');
});

// Student Routes (protected by auth and role filters)
$routes->group('student', ['filter' => 'auth'], function($routes) {
    $routes->get('courses', 'Student::courses');
    $routes->get('assignments', 'Student::assignments');
    $routes->get('grades', 'Student::grades');
});