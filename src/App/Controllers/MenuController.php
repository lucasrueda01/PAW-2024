<?php

namespace Paw\App\Controllers;

use Paw\App\Utils\Verificador;

use Paw\Core\Controller;

class MenuController extends Controller
{

    public Verificador $verificador;

    public function __construct()
    {
        parent::__construct();

        $this->verificador = new Verificador;
    }

    public function nuestroMenu()
    {
        $titulo = "PAW POWER | MENU";
        require $this->viewsDir . 'nuestro_menu.view.php';
    }

    public function promociones()
    {
        $titulo = "PAW POWER | PROMOCIONES";
        require $this->viewsDir . 'promociones.view.php';
    }    


}
