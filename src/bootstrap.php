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
$router->get('/about', 'PageController@about');
$router->get('/services', 'PageController@services');
$router->get('/contact', 'PageController@contact');
$router->post('/contact', 'PageController@contactProccess');
