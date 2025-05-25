<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('backoffice', function ($routes) {
    // Dashboard
    $routes->get('/', 'Backoffice\Dashboard::index');
    // User
    $routes->get('user', 'Backoffice\User::index');
});

$routes->group('bo-auth', function ($routes) {
    $routes->get('login', 'Backoffice\Auth::login');
    $routes->post('login/validate', 'Backoffice\Auth::loginValidate');
});
