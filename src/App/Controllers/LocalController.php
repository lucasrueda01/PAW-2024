<?php

namespace Paw\App\Controllers;

use Paw\App\Utils\Verificador;
use Paw\App\Models\PlatosCollection;

use Paw\Core\Controller;

class LocalController extends Controller
{

    public ?string $modelName = LocalCollection::class;

    public Verificador $verificador;

    public function __construct()
    {
        parent::__construct();

        $this->verificador = new Verificador;
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
                // Realizar la consulta a la base de datos para obtener las mesas del local
                // $mesas = obtenerMesasDelLocal($sucursalSeleccionada);

                    

                // Ejemplo de respuesta: enviar las mesas en formato JSON
                $mesas = array(
                    array("id" => 1, "nombre" => "mesa-161"),
                    array("id" => 2, "nombre" => "mesa-144"),
                    array("id" => 3, "nombre" => "mesa-143")
                );

                // Enviar las mesas como respuesta en formato JSON
                header("Content-Type: application/json");
                echo json_encode($mesas);

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
