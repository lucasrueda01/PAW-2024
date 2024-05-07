<?php

namespace Paw\App\Controllers;

use Paw\App\Utils\Verificador;

use Paw\Core\Controller;

class MesaController extends Controller
{

    public Verificador $verificador;

    public function __construct()
    {
        parent::__construct();

        $this->verificador = new Verificador;
    }

    public function gestion_lista_mesas()
    {
        $titulo = 'PAW POWER | GESTION MESAS';
        require $this->viewsDir . 'empleado/gestion_lista_mesas.view.php';
    }
    public function gestion_mesa()
    {
        $titulo = 'PAW POWER | GESTION MESA';
        require $this->viewsDir . 'empleado/gestion_mesa.view.php';
    }
    public function new()
    {
        global $request;

        if($request->method() == 'GET'){
            $titulo = 'PAW POWER | RESERVAR CLIENTE';
            require $this->viewsDirCliente . 'reservar_cliente.view.php';
        }elseif($request->method() == 'POST'){
            var_dump($_POST);
            echo("<pre>");
        }else{
            echo("Metodo no permitido");
        }

    }

    public function procesar_reserva_cliente()
    {
        $datosReserva = $_POST;
        // $resultado = $this->verificador->verificarCampos($datosReserva);
        require $this->viewsDirCliente . 'reservar_cliente.view.php';
    }    
}
