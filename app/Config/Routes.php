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
    // Layanan
    $routes->get('layanan', 'Backoffice\Layanan::index');
    $routes->post('layanan', 'Backoffice\Layanan::create');
    $routes->patch('layanan', 'Backoffice\Layanan::update');
    $routes->delete('layanan', 'Backoffice\Layanan::delete');
    // Obat
    $routes->get('obat', 'Backoffice\Obat::index');
    $routes->post('obat', 'Backoffice\Obat::create');
    $routes->patch('obat', 'Backoffice\Obat::update');
    $routes->delete('obat', 'Backoffice\Obat::delete');
    // Jadwal
    $routes->get('jadwal', 'Backoffice\Jadwal::index');
    $routes->get('jadwal/(:num)', 'Backoffice\Jadwal::detail/$1');
    $routes->post('jadwal', 'Backoffice\Jadwal::create');
    $routes->patch('jadwal', 'Backoffice\Jadwal::update');
    $routes->delete('jadwal', 'Backoffice\Jadwal::delete');
});

$routes->group('bo-auth', function ($routes) {
    $routes->get('login', 'Backoffice\Auth::login');
    $routes->post('login/validate', 'Backoffice\Auth::loginValidate');
});
