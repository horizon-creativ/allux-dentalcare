<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('', function ($routes) {
    $routes->get('/', 'Home::index');
    // Authentication
    $routes->get('login', 'User\Auth::login');
    $routes->get('register', 'User\Auth::register');
    $routes->post('login/validate', 'User\Auth::loginValidate');
    $routes->post('register/validate', 'User\Auth::registerValidate');
    $routes->get('logout', 'User\Auth::logout');
    // Profil
    $routes->get('profile', 'User\Profile::index');
    // Booking
    $routes->get('booking/date', 'User\Booking::date');
    $routes->get('booking/slot', 'User\Booking::slot');
    $routes->get('booking/layanan', 'User\Booking::layanan');
    $routes->post('booking/save', 'User\Booking::save');
    $routes->get('booking/(:num)', 'User\Booking::detail/$1');
    $routes->get('booking/cancel/(:num)', 'User\Booking::cancel/$1');
});

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
    // Pasien
    $routes->get('pasien', 'Backoffice\Pasien::index');
    // Booking Masuk
    $routes->get('booking-masuk', 'Backoffice\BookingMasuk::index');
    $routes->patch('booking-masuk', 'Backoffice\BookingMasuk::confirm');
    // Booking Pasien
    $routes->get('booking-pasien', 'Backoffice\BookingPasien::index');
    $routes->post('booking-pasien', 'Backoffice\BookingPasien::perawatan');
    $routes->get('booking-pasien/(:num)', 'Backoffice\BookingPasien::detail/$1');
    // Tambah layanan dan obat
    $routes->post('booking-pasien/layanan', 'Backoffice\BookingPasien::addLayanan');
    $routes->post('booking-pasien/obat', 'Backoffice\BookingPasien::addObat');
    // Edit dan Delete item
    $routes->patch('booking-pasien/item', 'Backoffice\BookingPasien::updateItem');
    $routes->delete('booking-pasien/item', 'Backoffice\BookingPasien::deleteItem');
    // Finish perawatan
    $routes->post('booking-pasien/finish', 'Backoffice\BookingPasien::finish');
    // Kasir
    $routes->get('kasir', 'Backoffice\Kasir::index');
    $routes->get('kasir/(:num)', 'Backoffice\Kasir::detail/$1');
    $routes->post('kasir/pay', 'Backoffice\Kasir::pay');
    $routes->get('kasir/print/(:num)', 'Backoffice\Kasir::print/$1');
});

$routes->group('bo-auth', function ($routes) {
    $routes->get('login', 'Backoffice\Auth::login');
    $routes->post('login/validate', 'Backoffice\Auth::loginValidate');
    $routes->get('logout', 'Backoffice\Auth::logout');
});
