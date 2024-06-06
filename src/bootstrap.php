<?php

require __DIR__.'/../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Level;
use Monolog\Handler\StreamHandler;
use Dotenv\Dotenv;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\Extension\DebugExtension;

use Paw\Core\App;
use Paw\Core\Router;
use Paw\Core\Config;
use Paw\Core\Request;
use Paw\Core\Database\ConnectionBuilder;

// echo phpinfo();

$dotenv = Dotenv::createUnsafeImmutable(__DIR__.'/../');

$dotenv->load();

$config = new Config;

$whoops = new \Whoops\Run;

$log = new Logger('mvc-app');
$handler = new StreamHandler(getenv('LOG_PATH'));
$handler->setLevel($config->get("LOG_LEVEL"));
$handler->setLevel(Level::Debug);

$log->pushHandler($handler);

$log->info('Datos de Config', [
    "adapter" => $config->get('DB_ADAPTER'),
    "hostname" => $config->get('DB_HOSTNAME'),
    "dbname" => $config->get('DB_DBNAME'),
    "port" => $config->get('DB_PORT'),
    "charset" => $config->get('DB_CHARSET'),
]);

$connectionBuilder = new ConnectionBuilder;
$connectionBuilder->setLogger($log);
$connection = $connectionBuilder->make($config);

$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);

$whoops->register();

$request = new Request;

$router = new Router;
$router->setLogger($log);

/**
 * Load template engine
 */
$loader = new FilesystemLoader(__DIR__ . $config->get('TEMPLATE_DIR'));
$twig = new Environment($loader, array(
    'cache' => __DIR__ . $config->get('TEMPLATE_CACHE_DIR'),
    'debug' => true,
));

// UsuarioController
$router->get('/iniciar_sesion', 'UsuarioController@inicio_sesion');
$router->post('/iniciar_sesion', 'UsuarioController@inicio_sesion');
$router->get('/cerrar_sesion', 'UsuarioController@cerrar_sesion');
$router->get('/registrar_usuario', 'UsuarioController@registrar_usuario');
$router->post('/registrar_usuario', 'UsuarioController@registrar_usuario');
$router->get('/perfil_usuario', 'UsuarioController@perfil');
// PageController
$router->get('/', 'PageController@index');
// EmpresaController
$router->get('/unete_al_equipo', 'EmpresaController@unete_al_equipo');
$router->get('/sucursales', 'EmpresaController@sucursales');
$router->get('/noticias', 'EmpresaController@noticias');
$router->get('/sobre_nosotros', 'EmpresaController@sobre_nosotros');
// MenuController
$router->get('/promociones', 'MenuController@promociones'); // MenuController
$router->get('/nuestro_menu', 'MenuController@nuestroMenu'); // MenuController
$router->get('/plato', 'MenuController@get'); // MenuController
$router->get('/plato-all-in-cart', 'MenuController@getPlatosInCart'); // MenuController
$router->get('/plato/verDetalle', 'MenuController@verDetalle'); // MenuController
$router->get('/plato/new', 'MenuController@new'); // MenuController
$router->post('/plato/new', 'MenuController@new'); // MenuController
$router->post('/plato/add-to-cart', 'MenuController@addToCart'); // MenuController

// LocalController
$router->get('/local/mesas', 'LocalController@getMesas'); // LocalController
// PedidoController
$router->get('/pedidos_entrantes', 'PedidosController@pedidos_entrantes'); // PedidoController
$router->get('/pedidos/estado', 'PedidosController@get'); // PedidoController
$router->get('/pedidos/get-estado', 'PedidosController@getEstado'); // PedidoController
$router->post('/pedido/new', 'PedidosController@new'); // PedidoController
$router->get('/pedidos/estado/modificar', 'PedidosController@modificarEstado'); // empleado
$router->get('/ver_mi_pedido', 'PedidosController@verPedido'); // empleado

// MesaController
$router->get('/reservar_cliente', 'MesaController@reservar_cliente'); // MesaController
$router->post('/reservar_cliente', 'MesaController@reservar_cliente'); // MesaController
$router->get('/locales/get', 'MesaController@getLocales'); // MesaController
$router->get('/gestion_lista_mesas', 'MesaController@gestion_lista_mesas'); // MesaController
$router->get('/gestion_mesa', 'MesaController@gestion_mesa'); // MesaController

$router->get('/sitemap', 'SEOController@generateSitemap');
$router->get('/robot', 'SEOController@generateRobot');
$router->get('/json-ld', 'SEOController@generateJsonLd');


// Cargar motor de plantillas
$templateDir = __DIR__ . $config->get('TEMPLATE_DIR');
$cacheDir = __DIR__ . $config->get('TEMPLATE_CACHE_DIR');

$log->info('Template Directory:', [$templateDir]);
$log->info('Cache Directory:', [$cacheDir]);

$loader = new FilesystemLoader($templateDir);

$log->info('loader: ', [$loader, $templateDir]);

$twig = new Environment($loader, [
    'cache' => $cacheDir, 
    'debug' => true,
]);

$twig->addExtension(new DebugExtension());

