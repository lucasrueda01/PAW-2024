<?php

namespace Paw\App\Controllers;

use Paw\App\Utils\Verificador;
use Paw\App\Controllers\UsuarioController;
use Paw\Core\Controller;

class MesaController extends Controller
{
    public static $locales = [
        "Local A" => [
            "horaApertura" => "09:00",
            "horaCierre" => "21:00",
            "mesa" => ["mesa-162", "mesa-161", "mesa-144", "mesa-143", "mesa-142", "mesa-141", "mesa-126", "mesa-125", "mesa-124", "mesa-123", "mesa-122", "mesa-121", "mesa-342", "mesa-341", "mesa-322", "mesa-321", "mesa-262", "mesa-261", "mesa-241", "mesa-223", "mesa-222", "mesa-221"],
            "2024/05/07" => [
                "mesa-143" => [
                    ["horaInicio" => '09:00', "horaFin" => '10:30'],
                    ["horaInicio" => '13:00', "horaFin" => '14:30'],
                    ["horaInicio" => '15:00', "horaFin" => '16:30']
                ],
                "mesa-161" => [
                    ["horaInicio" => '13:00', "horaFin" => '14:30'],
                    ["horaInicio" => '15:00', "horaFin" => '16:30']
                ],
                "mesa-144" => [
                    ["horaInicio" => '13:00', "horaFin" => '14:30'],
                    ["horaInicio" => '15:00', "horaFin" => '16:30']
                ]
            ],
            "2024/05/08" => [
                "mesa-143" => [
                    ["horaInicio" => '09:00', "horaFin" => '10:30'],
                    ["horaInicio" => '13:00', "horaFin" => '14:30'],
                    ["horaInicio" => '19:00', "horaFin" => '20:30']
                ],
                "mesa-161" => [
                    ["horaInicio" => '13:00', "horaFin" => '14:30'],
                    ["horaInicio" => '15:00', "horaFin" => '16:30']
                ],
                "mesa-144" => [
                    ["horaInicio" => '13:00', "horaFin" => '14:30'],
                    ["horaInicio" => '15:00', "horaFin" => '16:30']
                ]
            ]
        ],
        "Local B" => [
            "horaApertura" => "09:00",
            "horaCierre" => "21:00",
            "mesa" => ["mesa-162", "mesa-161", "mesa-144", "mesa-143", "mesa-142", "mesa-141", "mesa-126", "mesa-125", "mesa-124", "mesa-123", "mesa-122", "mesa-121", "mesa-342", "mesa-341", "mesa-322", "mesa-321", "mesa-262", "mesa-261", "mesa-241", "mesa-223", "mesa-222", "mesa-221"],
            "2024/05/08" => [
                "mesa-143" => [
                    ["horaInicio" => '13:00', "horaFin" => '14:30'],
                    ["horaInicio" => '15:00', "horaFin" => '16:30']
                ],
                "mesa-161" => [
                    ["horaInicio" => '13:00', "horaFin" => '14:30'],
                    ["horaInicio" => '15:00', "horaFin" => '16:30']
                ],
                "mesa-144" => [
                    ["horaInicio" => '13:00', "horaFin" => '14:30'],
                    ["horaInicio" => '15:00', "horaFin" => '16:30']
                ]
            ]
        ]
    ];    

    public Verificador $verificador;

    public function __construct()
    {
        parent::__construct();

        $this->verificador = new Verificador;
        $usuario = new UsuarioController();
        list($this->menuPerfil, $this->menuEmpleado) = $usuario->adjustMenuForSession($this->menuPerfil, $this->menuEmpleado);
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

    public function getLocales()
    {
        header('Content-Type: application/json');
        echo json_encode(self::$locales);
    }

    // public function getLocales(){
    //     return self::$locales;
    // }

    public function reservar_cliente()
    {
        global $request;

        $titulo = 'PAW POWER | RESERVAR CLIENTE';

        /**
         * controlar que el methodo solicitado sea get o post
         */
        if($request->method() == 'POST'){
            $resultado = [
                "resumen" => [
                    "nombre" => $request->get('nombre'),
                    "dni" => $request->get('dni'),
                    "local" => $request->get('local'),
                    "date" => $request->get('date'),
                    "time" => $request->get('time'),
                    "mesa-elegida" => $request->get('nromesa-elegida')
                ]
            ];
        }
        require $this->viewsDirCliente . 'reservar_cliente.view.php';
    }
   

}
