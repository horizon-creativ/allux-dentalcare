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
    $routes->post('user', 'Backoffice\User::create');
    $routes->patch('user', 'Backoffice\User::update');
    $routes->delete('user', 'Backoffice\User::delete');
});

$routes->group('bo-auth', function ($routes) {
    $routes->get('login', 'Backoffice\Auth::login');
    $routes->post('login/validate', 'Backoffice\Auth::loginValidate');
});
