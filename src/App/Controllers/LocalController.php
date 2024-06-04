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
         

        if($request->method() == 'GET'){
           
            // Verificar si se recibieron los datos esperados

            $locales = new LocalesCollection();

            // Enviar las mesas como respuesta en formato JSON
            header("Content-Type: application/json");
            echo json_encode($locales->obtenerMesas());

        } else {
            // Si la solicitud no es de tipo POST, enviar una respuesta de error
            http_response_code(405);
            echo json_encode(array("mensaje" => "Método no permitido"));
        }                 

    }

}
