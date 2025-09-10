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
