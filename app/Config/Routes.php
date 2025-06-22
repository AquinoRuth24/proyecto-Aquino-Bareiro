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
$routes->get('/carrito', 'Home::carrito');

// Consultas
$routes->get('/consulta', 'ConsultaController::index'); 
$routes->post('/consultas/enviar', 'ConsultaController::enviar');
$routes->get('mis_consultas', 'ConsultaController::misConsultas');

// Consultas de usuarios (página de administración)
$routes->get('admin/consultas', 'ConsultaController::admin');
$routes->get('consultas/marcarContestado/(:num)', 'ConsultaController::marcarContestado/$1');
$routes->match(['get', 'post'], 'consultas/responder/(:num)', 'ConsultaController::responder/$1');


//$routes->get('/consultas', 'Home::consultas');
$routes->get('/consultas', 'Consultas::index'); 
$routes->post('/consultas/enviar', 'Consultas::enviar');

// Formulario de contacto (formulario separado de consultas)
$routes->post('/contacto/mensaje', 'Home::enviarMensaje');

// Autenticación
$routes->match(['get', 'post'], 'login', 'UsuarioController::login');
$routes->get('/logout', 'UsuarioController::logout');

// Registro de usuarios y administradores
$routes->get('/registrar', 'usuarioController::registrar');
$routes->post('/registrar', 'usuarioController::registrar');
$routes->get('/administrador', 'AdministradorController::administrador');


// Página principal después del login
/*$routes->get('/principal', 'Principal::index');*/
$routes->get('/usuarioLogeado', 'UsuarioController::usuarioLogeado');


// Si deseas permitir ambas formas de acceso (GET y POST) a login o registrar:
$routes->match(['get', 'post'], 'login', 'usuarioController::login');
$routes->match(['get', 'post'], 'registrar', 'usuarioController::registrar');

// productos
$routes->get('/producto', 'ProductoController::index');
$routes->match(['get', 'post'], '/producto/crearProducto', 'ProductoController::crearProducto');
$routes->get('/producto/eliminarProducto/(:num)', 'ProductoController::eliminarProducto/$1');
$routes->get('/producto/productosEliminados', 'ProductoController::productosEliminados');
$routes->get('/producto/restaurarProducto/(:num)', 'ProductoController::restaurarProducto/$1');

// ventas
$routes->get('admin/ventas', 'AdministradorController::ventas');
$routes->get('admin/facturas', 'AdministradorController::facturas');

// Categorías
$routes->get('catalogoProductos', 'CatalogoController::index');
