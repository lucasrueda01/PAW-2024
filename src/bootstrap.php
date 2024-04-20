<?php

require __DIR__.'/../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Level;
use Monolog\Handler\StreamHandler;
use Dotenv\Dotenv;

use Paw\Core\Router;
use Paw\Core\Config;
use Paw\Core\Request;

$dotenv = Dotenv::createUnsafeImmutable(__DIR__.'/../');

$dotenv->load();

$config = new Config;



$whoops = new \Whoops\Run;

$log = new Logger('mvc-app');
$handler = new StreamHandler(getenv('LOG_PATH'));
$handler->setLevel($config->get("LOG_LEVEL"));
$handler->setLevel(Level::Debug);

$log->pushHandler($handler);

$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);

$whoops->register();

$request = new Request;

$router = new Router;
$router->setLogger($log);

// UsuarioController
$router->get('/iniciar_sesion', 'UsuarioController@inicio_sesion');
$router->get('/registrar_usuario', 'UsuarioController@registrar_usuario');
$router->get('/perfil_usuario', 'UsuarioController@perfil');
// PageController
$router->get('/', 'PageController@index');
// EmpresaController
$router->get('/unete_al_equipo', 'EmpresaController@unete_al_equipo');
$router->get('/sucursales', 'EmpresaController@sucursales');
$router->get('/noticias', 'EmpresaController@noticias');
$router->get('/sobre_nosotros', 'EmpresaController@sobre_nosotros');
// MenuController
$router->get('/promociones', 'MenuController@promociones');
$router->get('/nuestro_menu', 'MenuController@nuestroMenu');
// PedidoController
$router->get('/pedir', 'PedidoController@pedir'); // PedidoController
$router->get('/pedidos_entrantes', 'PedidoController@pedidos_entrantes'); // PedidoController
// PlatoController
$router->get('/nuevo_plato', 'PlatoController@nuevo_plato'); // PlatoController
$router->post('/datos_plato', 'PlatoController@datos_plato'); // PlatoController
// MesaController
$router->get('/reservar_cliente', 'MesaController@reservar_cliente'); // MesaController
$router->post('/reservar_cliente', 'MesaController@procesar_reserva_cliente'); // MesaController
$router->get('/gestion_lista_mesas', 'MesaController@gestion_lista_mesas'); // MesaController
$router->get('/gestion_mesa', 'MesaController@gestion_mesa'); // MesaController

