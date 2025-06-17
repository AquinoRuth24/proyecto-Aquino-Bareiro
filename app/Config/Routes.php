<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Página principal
$routes->get('/', 'Home::index');

// Páginas informativas
$routes->get('/quienesSomos', 'Home::quienesSomos');
$routes->get('/comercializacion', 'Home::comercializacion');
$routes->get('/informacionContacto', 'Home::informacionContacto');
$routes->get('/terminosYUsos', 'Home::terminosYUsos');
$routes->get('/registrar', 'Home::registrar');

// Catálogo y carrito
$routes->get('/catalogoProductos', 'Home::catalogoProductos');
$routes->get('/carrito', 'Home::carrito');

// Consultas
$routes->get('/consultas', 'Home::consultas');
$routes->get('/consultas', 'Consultas::index'); 
$routes->post('/consultas/enviar', 'Consultas::enviar');

// Formulario de contacto (formulario separado de consultas)
$routes->post('/contacto/mensaje', 'Home::enviarMensaje');

// Autenticación
$routes->get('/login', 'usuarioController::login');
$routes->post('/login', 'usuarioController::login');

$routes->get('/logout', 'usuarioController::logout');

// Registro de usuarios
$routes->get('/registrar', 'usuarioController::registrar');
$routes->post('/registrar', 'usuarioController::registrar');

// Página principal después del login
$routes->get('/principal', 'Principal::index');
$routes->get('/usuarioLogeado', 'usuarioController::usuarioLogeado');


// Si deseas permitir ambas formas de acceso (GET y POST) a login o registrar:
$routes->match(['get', 'post'], 'login', 'usuarioController::login');
$routes->match(['get', 'post'], 'registrar', 'usuarioController::registrar');
