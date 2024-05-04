<?php

namespace Paw\App\Controllers;

use Paw\App\Utils\Verificador;
use Paw\App\Models\LocalesCollection;
use Paw\App\Models\MesasCollection;
use Paw\App\Models\ReservasCollection;
use Paw\App\Models\Local;
use Paw\App\Models\Mesa;

use Paw\Core\Controller;

class LocalController extends Controller
{

    public ?string $modelName = LocalesCollection::class;

    public Verificador $verificador;

    public function __construct()
    {
        parent::__construct();

        $this->verificador = new Verificador;
    }

    public function getMesas()
    {
        global $request;
         

        if($request->method() == 'GET'){
           
            // Verificar si se recibieron los datos esperados
            if (null !== $request->get("local") && null !== $request->get('date') && null !== $request->get('time')){ 

                $localSeleccionado = $request->get("local");
                $fecha = $request->get('date');
                $hora = $request->get('time');

                $locales = new LocalesCollection();

                list($ocupadas, $desocupadas) = $locales->obtenerMesas($localSeleccionado, $fecha, $hora);

                $reservasDelLocal = array(
                    "ocupadas" => $ocupadas,
                    "desocupadas" => $desocupadas
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
