<?php

namespace Paw\App\Controllers;

use Paw\App\Utils\Verificador;

use Paw\Core\Controller;

class PedidoController extends Controller
{

    public Verificador $verificador;

    public function __construct()
    {
        parent::__construct();

        $this->verificador = new Verificador;
    }

    public function pedidos_entrantes()
    {
        $titulo = 'PAW POWER | PEDIDOS';
        require $this->viewsDir . 'empleado/pedidos_entrantes.view.php';
    }

    public function pedir()
    {
        $titulo = 'PAW POWER | PEDIR';
        require $this->viewsDirCliente . 'pedir.view.php';
    }
}