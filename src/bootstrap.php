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

$router->get('/', 'PageController@index');
$router->get('/nuestro_menu', 'PageController@nuestroMenu');
$router->get('/promociones', 'PageController@promociones');
$router->get('/sucursales', 'PageController@sucursales');
$router->get('/noticias', 'PageController@noticias');
$router->get('/sobre_nosotros', 'PageController@sobre_nosotros');
$router->get('/reservar_cliente', 'PageController@reservar_cliente');
$router->post('/reservar_cliente', 'PageController@post_reservar_cliente');
$router->get('/unete_al_equipo', 'PageController@unete_al_equipo');
$router->get('/pedir', 'PageController@pedir');
$router->get('/nuevo_plato', 'PageController@nuevo_plato');
$router->post('/datos_plato', 'PageController@datos_plato');
$router->get('/gestion_lista_mesas', 'PageController@gestion_lista_mesas');
$router->get('/gestion_mesa', 'PageController@gestion_mesa');
$router->get('/pedidos_entrantes', 'PageController@pedidos_entrantes');
$router->get('/iniciar_sesion', 'PageController@inicio_sesion');
$router->get('/registrar_usuario', 'PageController@registrar_usuario');
$router->get('/perfil_usuario', 'PageController@perfil');

