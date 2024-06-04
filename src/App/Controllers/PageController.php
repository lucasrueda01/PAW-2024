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
    public $data;

    public function __construct()
    {
        global $log;
        
        parent::__construct();

        $this->uploader = new Uploader;

        $this->verificador = new Verificador;

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

    public function index()
    {

        $this->data['titulo'] = "PAW POWER | HOME";

        view('index.view', $this->data);
    }


}


