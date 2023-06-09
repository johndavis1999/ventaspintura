<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('login', 'Login::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

#login
$routes->get('registro', 'Login::registro');
$routes->post('acceder', 'Login::acceder');
$routes->get('salir', 'Login::cerrarSesion');

<<<<<<< HEAD



#usuarios

#$routes->get('usuarios', 'User::index');
$routes->get('usuarios', 'User::index', ['filter' => 'verificarSesion']);
#$routes->get('UsuariosCrear', 'User::crear');
$routes->get('UsuariosCrear', 'User::crear', ['filter' => 'verificarSesion']);
#$routes->post('guardarUsuario', 'User::guardar');
$routes->post('guardarUsuario', 'User::guardar', ['filter' => 'verificarSesion']);
$routes->get('eliminarUsuario/(:num)', 'User::eliminar/$1', ['filter' => 'verificarSesion']);
$routes->get('editarUsuario/(:num)', 'User::editar/$1', ['filter' => 'verificarSesion']);
$routes->post('actualizarUsuario', 'User::actualizar', ['filter' => 'verificarSesion']);



#$routes->get('dashboard', 'Dashboard::index');
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'verificarSesion']);

#Personas
$routes->get('personas', 'Persona::index', ['filter' => 'verificarSesion']);
$routes->get('crearPersona', 'Persona::crear', ['filter' => 'verificarSesion']);
$routes->post('guardarPersona', 'Persona::guardar', ['filter' => 'verificarSesion']);
$routes->get('eliminarPersona/(:num)', 'Persona::eliminar/$1', ['filter' => 'verificarSesion']);
$routes->get('editarPersona/(:num)', 'Persona::editar/$1', ['filter' => 'verificarSesion']);
$routes->post('actualizarPersona', 'Persona::actualizar', ['filter' => 'verificarSesion']);



#facturacion
$routes->get('crearFact', 'Facturacion::crear', ['filter' => 'verificarSesion']);
$routes->get('  ', 'Facturacion::ver', ['filter' => 'verificarSesion']);
=======
#usuarios
$routes->get('usuarios', 'User::index');
$routes->get('UsuariosCrear', 'User::crear');
$routes->post('guardarUsuario', 'User::guardar');



$routes->get('dashboard', 'Dashboard::index');
>>>>>>> d1476fef7db13c36fbe91007409866aadda36ff2
