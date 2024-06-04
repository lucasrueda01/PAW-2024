<?php

namespace Paw\App\Controllers;

use Paw\App\Utils\Verificador;

use Paw\Core\Controller;
use Paw\App\Models\MesasCollection;
use Paw\App\Models\Reserva;
use Paw\App\Models\Local;
use Paw\App\Models\Mesa;
use PDOException;

class MesaController extends Controller
{

    public Verificador $verificador;
    public ?string $modelName = MesasCollection::class;
    public $data;

    public function __construct()
    {
        global $log;

        parent::__construct();

        $this->verificador = new Verificador;
        $usuario = new UsuarioController();
        list($this->menuPerfil, $this->menuEmpleado) = $usuario->adjustMenuForSession($this->menuPerfil, $this->menuEmpleado);

        $this->data = [
            'menu' => $this->menu,
            'menuPerfil' => $this->menuPerfil,
        ];
        
        if (!empty($this->menuEmpleado)) {
            $this->data['menuEmpleado'] = $this->menuEmpleado;
            $log->info('menuEmpleado: ' , [$this->menuEmpleado, !empty($this->menuEmpleado)]);
        }
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

        $titulo = 'PAW POWER | RESERVAR CLIENTE';

        if($request->method() == 'POST'){
            $nombre = $request->get('nombre');
            $dni = $request->get('dni');
            $local_nombre = $request->get('local');
            $fecha = $request->get('date');
            $hora_inicio = $request->get('time');
            $mesa_nombre = $request->get('nromesa-elegida');
            
            $local = new Local([], $this->qb);
            $mesa = new Mesa([], $this->qb);
            $reserva = new Reserva([], $this->qb);

            try {
                $local_id = $local->loadByName($local_nombre);
                $mesa_id = $mesa->getIdByNameAndLocal($mesa_nombre, $local_id);

                if($local_id && $mesa_id) {
                    $hora_fin = date('H:i:s', strtotime($hora_inicio) + 1 * 3600); 

                    $reservaData = [
                        'mesa_id' => $mesa_id,
                        'fecha' => $fecha,
                        'hora_inicio' => $hora_inicio,
                        'hora_fin' => $hora_fin,
                    ];

                    [$idGenerado, $result] = $reserva->insert($reservaData);

                    if($result) {
                        $resultado = [
                            "resumen" => [
                                "nombre" => $nombre,
                                "dni" => $dni,
                                "local" => $local,
                                "date" => $fecha,
                                "time" => $hora_inicio,
                                "mesa-elegida" => $mesa_nombre
                            ],
                            "success" => true,
                            "message" => "Reserva realizada con éxito."
                        ];
                    } else {
                        $resultado = [
                            "success" => false,
                            "message" => "Error al realizar la reserva."
                        ];
                    }
                } else {
                    $resultado = [
                        "success" => false,
                        "message" => "Local o mesa no encontrados."
                    ];
                }
            } catch (PDOException $e) {
                $this->qb->logger->error("Error al realizar la reserva: " . $e->getMessage());
                $resultado = [
                    "success" => false,
                    "message" => "Ocurrió un error al procesar su solicitud. Por favor, inténtelo de nuevo más tarde."
                ];
            }
        }

        require $this->viewsDirCliente . 'reservar_cliente.view.php';
    }
}
