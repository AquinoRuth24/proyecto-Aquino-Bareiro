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
$routes->get('/login', 'Home::login');
$routes->post('/consultas/enviar', 'Home::enviarConsulta');
$routes->get('/registrar', 'Home::registrar');
$routes->post('/registrar/guardar', 'Home::guardarUsuario');