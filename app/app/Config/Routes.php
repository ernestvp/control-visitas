<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::login');

// Rutas de autenticación
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::loginPost');
$routes->get('/logout', 'Auth::logout');

// Rutas de visitas
$routes->get('/visitas', 'Visitas::index');
$routes->get('/visitas/registro', 'Visitas::registro');
$routes->post('/visitas/registro', 'Visitas::registroPost');
$routes->get('/visitas/salida/(:num)', 'Visitas::salida/$1');
$routes->get('/setup', 'Auth::setup');