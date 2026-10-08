<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Public pages
$routes->get('/', 'Tasks::today');
$routes->get('tasks', 'Tasks::index');
$routes->get('profile', 'Profile::index');
$routes->get('about', 'Pages::about');

// Authentication
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attempt');
$routes->post('logout', 'Auth::logout');

// Protected task-management routes
$routes->get(
    'tasks/new',
    'Tasks::new',
    ['filter' => 'auth']
);

$routes->post(
    'tasks',
    'Tasks::create',
    ['filter' => 'auth']
);

$routes->get(
    'tasks/(:num)/edit',
    'Tasks::edit/$1',
    ['filter' => 'auth']
);

$routes->post(
    'tasks/(:num)',
    'Tasks::update/$1',
    ['filter' => 'auth']
);

$routes->post(
    'tasks/(:num)/archive',
    'Tasks::archive/$1',
    ['filter' => 'auth']
);