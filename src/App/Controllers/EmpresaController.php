<?php

namespace Paw\App\Controllers;

use Paw\App\Utils\Verificador;
use Paw\App\Controllers\UsuarioController;
use Paw\Core\Controller;

class EmpresaController extends Controller
{

    public Verificador $verificador;

    public function __construct()
    {
        parent::__construct();

        $this->verificador = new Verificador;
        $usuario = new UsuarioController();
        list($this->menuPerfil, $this->menuEmpleado) = $usuario->adjustMenuForSession($this->menuPerfil, $this->menuEmpleado);
    }

    public function sucursales()
    {
        $titulo = "PAW POWER | SUCURSALES";
        require $this->viewsDir . 'sucursales.view.php';
    }

    public function noticias()
    {
        $titulo = "PAW POWER | NOTICIAS";
        require $this->viewsDir . 'noticias.view.php';
    }

    public function sobre_nosotros()
    {
        $titulo = 'PAW POWER | SOBRE_NOSOTROS';
        require $this->viewsDir . 'sobre_nosotros.view.php';
    }

    public function unete_al_equipo()
    {
        $titulo = 'PAW POWER | UNETE AL EQUIPO';
        require $this->viewsDir . 'unete_al_equipo.view.php';
    }


}
