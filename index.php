<?php
require_once 'router.php';
require_once 'aplicacion/controladores/controladorpublico.php';
require_once 'aplicacion/controladores/controladorauth.php';
require_once 'aplicacion/controladores/controladoradmin.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$router = new Router();

$router->addRuta("home", "controladorpublico", "mostrarHome");
$router->addRuta("libro", "controladorpublico", "mostrarDetalleLibro");
$router->addRuta("autores", "controladorpublico", "mostrarAutores");
$router->addRuta("autor", "controladorpublico", "mostrarLibrosPorAutor");

$router->addRuta("login", "controladorauth", "mostrarLogin");
$router->addRuta("autenticar", "controladorauth", "autenticar");
$router->addRuta("logout", "controladorauth", "logout");

$router->addRuta("admin/libros", "controladoradmin", "mostrarPanelLibros");
$router->addRuta("admin/libros/agregar", "controladoradmin", "agregarLibro");
$router->addRuta("admin/libros/eliminar", "controladoradmin", "eliminarLibro");
$router->addRuta("admin/libros/editar", "controladoradmin", "mostrarFormularioEditar");
$router->addRuta("admin/libros/actualizar", "controladoradmin", "actualizarLibro");

$router->addRuta("admin/autores", "controladoradmin", "mostrarPanelAutores");
$router->addRuta("admin/autores/agregar", "controladoradmin", "agregarAutor");
$router->addRuta("admin/autores/eliminar", "controladoradmin", "eliminarAutor");
$router->addRuta("admin/autores/editar", "controladoradmin", "mostrarFormularioEditarAutor");
$router->addRuta("admin/autores/actualizar", "controladoradmin", "actualizarAutor");

$router->setRutaPorDefecto("controladorpublico", "mostrarHome");

$url = isset($_GET['url']) ? $_GET['url'] : 'home';
$router->route($url);