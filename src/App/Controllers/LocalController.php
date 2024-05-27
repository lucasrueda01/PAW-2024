<?php

namespace Paw\App\Controllers;

use Paw\App\Utils\Verificador;
use Paw\App\Models\LocalesCollection;
use Paw\App\Models\MesasCollection;
use Paw\App\Models\ReservasCollection;
use Paw\App\Models\Local;


use Paw\App\Controllers\UsuarioController;
use Paw\Core\Controller;

class LocalController extends Controller
{

    public ?string $modelName = LocalesCollection::class;

    public Verificador $verificador;

    public function __construct()
    {
        parent::__construct();

        $this->verificador = new Verificador;
        $usuario = new UsuarioController();
        list($this->menuPerfil, $this->menuEmpleado) = $usuario->adjustMenuForSession($this->menuPerfil, $this->menuEmpleado);   
    }

    public function getMesas()
    {
        global $request;

        if($request->method() == 'POST'){
            $datosJson = file_get_contents("php://input");
            // Decodificar los datos JSON en un array asociativo
            $datos = json_decode($datosJson, true);
           
            // Verificar si se recibieron los datos esperados
            if (isset($datos["local"])) {

                $localSeleccionado = $datos["local"];

                $local = new Local(
                    ['nombre_local' => $localSeleccionado]
                );

                $local->setQueryBuilder($this->getQb());
                

                $local->loadByName();

                $mesasDelLocal = new MesasCollection($local->getId());

                $mesas = $mesasDelLocal->getAll();

                // $reservas = new ReservasCollection($local->getId(), $mesas);

                // list($ocupadas, $desocupadas) = $reservas->getAll();

                // // Ejemplo de respuesta: enviar las mesas en formato JSON
                // $reservasDelLocal = array(
                //     "ocupadas" => $ocupadas,
                //     "desocupadas" => $desocupadas
                // );
                $reservasDelLocal = array(
                    "ocupadas" => $local->getNombreLocal(),
                    "desocupadas" => $mesas
                );

                // Enviar las mesas como respuesta en formato JSON
                header("Content-Type: application/json");
                echo json_encode($reservasDelLocal);

            } else {
                // Si faltan datos en la solicitud, enviar una respuesta de error
                http_response_code(400);
                echo json_encode(array("mensaje" => "Faltan datos en la solicitud"));
            }
        } else {
            // Si la solicitud no es de tipo POST, enviar una respuesta de error
            http_response_code(405);
            echo json_encode(array("mensaje" => "Método no permitido"));
        }                 

    }

}
