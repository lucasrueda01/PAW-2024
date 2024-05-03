<?php

namespace Paw\App\Controllers;

use Paw\App\Utils\Verificador;

use Paw\Core\Controller;

class UsuarioController extends Controller
{

    public Verificador $verificador;

    public function __construct()
    {
        parent::__construct();

        $this->verificador = new Verificador;
    }

    public function inicio_sesion() {
        $titulo = 'PAW POWER | SESION';
        require $this->viewsDir . 'inicio_sesion.view.php';

    }
    public function registrar_usuario() {
        $titulo = 'PAW POWER | REGISTRO';
        require $this->viewsDir . 'registrar_usuario.view.php';
    }

    public function perfil() {
        $titulo = 'PAW POWER | PERFIL';
        require $this->viewsDir . 'mi_perfil.view.php';
    }

}
