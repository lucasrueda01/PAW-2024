<?php

namespace Paw\App\Controllers;

use Paw\Core\Controller;


class ErrorController extends Controller
{
    public $data;

    public function __construct(){

        global $log;

        parent::__construct();
        
        $this->viewsDir = __DIR__ . '/../views/errors/';
        $usuario = new UsuarioController();
        list($this->menuPerfil, $this->menuEmpleado) = $usuario->adjustMenuForSession($this->menuPerfil, $this->menuEmpleado);   

        $this->data = [
            'menu' => $this->menu,
            'menuPerfil' => $this->menuPerfil,
        ];
        
        if (!empty($this->menuEmpleado)) {
            $this->data['menuEmpleado'] = $this->menuEmpleado;
            $log->info('menuEmpleado: ' , [$this->menuEmpleado, !empty($this->menuEmpleado)]);
        }
    }
    
    public function notFound() {
        http_response_code(404);
        $titulo = 'Page Not Found';
        $main = 'Page Not Found';
        require $this->viewsDir. 'not-found.view.php';
    }
    
    public function internalError() {
        http_response_code(500);
        $titulo = 'Internal Error';
        $main = 'Internal Server Error';
        require $this->viewsDir. 'internal-error.view.php';
    }

    
}