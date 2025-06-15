<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/quienesSomos', 'Home::quienesSomos');
$routes->get('/comercializacion', 'Home::comercializacion');
$routes->get('/informacionContacto', 'Home::informacionContacto');
$routes->get('/terminosYUsos', 'Home::terminosYUsos');
$routes->get('/catalogoProductos', 'Home::catalogoProductos');
$routes->get('/consultas', 'Home::consultas');
$routes->get('/carrito', 'Home::carrito');
$routes->post('/contacto/mensaje', 'Home::enviarMensaje');
$routes->get('/consultas', 'Consultas::index');
$routes->post('/consultas/enviar', 'Consultas::enviar');

$routes->get('/registrar', 'Home::registrar');

$routes->get('/login', 'usuarioController::login');
$routes->post('/login', 'usuarioController::login');
$routes->get('/logout', 'usuarioController::logout');
$routes->get('/registro', 'usuarioController::registrar');
$routes->post('/registro', 'usuarioController::registrar');
$routes->get('/principal', 'Principal::index');

/**guardar los usuarios */
$routes->match(['get', 'post'], 'registrar', 'usuarioController::registrar');
$routes->match(['get', 'post'], 'login', 'usuarioController::login');
