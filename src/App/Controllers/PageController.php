<?php

namespace Paw\App\Controllers;

use Paw\App\Utils\Verificador;
use Paw\App\Utils\Uploader;

use Paw\Core\Controller;
use Paw\App\Controllers\UsuarioController;

class PageController extends Controller
{

    public Uploader $uploader;
    public Verificador $verificador;

    public function __construct()
    {
        parent::__construct();

        $this->uploader = new Uploader;

        $this->verificador = new Verificador;

        $usuario = new UsuarioController();
        list($this->menuPerfil, $this->menuEmpleado) = $usuario->adjustMenuForSession($this->menuPerfil, $this->menuEmpleado);
    }

    public function index()
    {
        global $log;
        $titulo = "PAW POWER | HOME";
        // require $this->viewsDir . 'index.view.php';

        $data = [
            'menu' => $this->menu,
            'menuPerfil' => $this->menuPerfil,
            'titulo' => $titulo,
        ];
        
        if (!empty($this->menuEmpleado)) {
            $data['menuEmpleado'] = $this->menuEmpleado;
            $log->info('menuEmpleado: ' , [$this->menuEmpleado, !empty($this->menuEmpleado)]);
        }

        view('index.view', $data);
    }


}


