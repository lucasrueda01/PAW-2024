<?php

namespace Paw\App\Controllers;

use Paw\App\Utils\Verificador;
use Paw\App\Controllers\UsuarioController;
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
    public $usuario;

    public function __construct()
    {
        global $log;

        parent::__construct();

        $this->verificador = new Verificador;
        $this->usuario = new UsuarioController();
        list($this->menuPerfil, $this->menuEmpleado) = $this->usuario->adjustMenuForSession($this->menuPerfil, $this->menuEmpleado);

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

    public function getLocales()
    {
        header('Content-Type: application/json');
        // echo json_encode(self::$locales);
        echo json_encode($this->model->getReservas());
    }

    public function reservar_cliente()
    {
        global $log;
    
        $titulo = 'PAW POWER | RESERVAR CLIENTE';
    
        // Verificar si hay sesión iniciada
        if (!$this->usuario->isUserLoggedIn()) {
            $resultado = [
                "success" => false,
                "message" => "Debe iniciar sesión para realizar una reserva."
            ];
            $log->info("Intento de reserva sin sesión iniciada.");
            require $this->viewsDir . 'inicio_sesion.view.php';
            return;
        }
    
        if ($this->request->method() == 'POST') {
            $nombre = $this->request->get('nombre');
            $dni = $this->request->get('dni');
            $local_nombre = $this->request->get('local');
            $fecha = $this->request->get('date');
            $hora_inicio = $this->request->get('time');
            $mesa_nombre = $this->request->get('nromesa-elegida');
            
            $local = new Local([], $this->qb);
            $mesa = new Mesa([], $this->qb);
            $reserva = new Reserva([], $this->qb);
    
            try {
                $local->loadByName($local_nombre);
                $local_id = $local->getId();
                $mesa->loadByName($mesa_nombre);
                $mesa_id = $mesa->getId();
                $log->info("0- local y mesa: ", [$local_id, $mesa_id]);
                if ($local_id && $mesa_id) {
                    $log->info("1-existe local y mesa: ", [$local_id, $mesa_id]);
                    $hora_fin = date('H:i:s', strtotime($hora_inicio) + 1.5 * 3600);
    
                    $reservaData = [
                        'mesa_id' => $mesa_id,
                        'fecha' => $fecha,
                        'hora_inicio' => $hora_inicio,
                        'hora_fin' => $hora_fin,
                        'id_local' => $local_id,
                        'id_user' => $this->usuario->getUserId(), // Usar el método para obtener el ID de usuario
                    ];
    
                    [$idGenerado, $result] = $reserva->insert($reservaData);
    
                    $log->info("2-resultadoInsert: ", [$result]);
                    if ($result) {
                        $resultado = [
                            "resumen" => [
                                "nombre" => $nombre,
                                "dni" => $dni,
                                "local" => $local_nombre,
                                "date" => $fecha,
                                "time" => $hora_inicio,
                                "mesa-elegida" => $mesa_nombre,
                                "limite_reserva" => $hora_fin
                            ],
                            "success" => true,
                            "message" => "Reserva realizada con éxito."
                        ];
                        $log->info("3-resultado SUCCESS: ", [$resultado]);
                    } else {
                        $resultado = [
                            "success" => false,
                            "message" => "Error al realizar la reserva."
                        ];
                        $log->info("3.b-resultado fallo: ", [$resultado]);
                    }
                } else {
                    $resultado = [
                        "success" => false,
                        "message" => "Local o mesa no encontrados."
                    ];
                    $log->info("2.b-resultado fallo: ", [$resultado]);
                }
            } catch (PDOException $e) {
                $this->qb->logger->error("Error al realizar la reserva: " . $e->getMessage());
                $resultado = [
                    "success" => false,
                    "message" => "Ocurrió un error al procesar su solicitud. Por favor, inténtelo de nuevo más tarde."
                ];
            }
        }
        if (isset($resultado)) {
            $log->info("resultado: ", [$resultado]);
        }
        require $this->viewsDirCliente . 'reservar_cliente.view.php';
    }

    public function getReservas()
    {
        $local = $this->request->get('local');
        $fecha = $this->request->get('fecha');
        $hora = $this->request->get('hora');

        if (!$local || !$fecha || !$hora) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Faltan parámetros']);
            return;
        }

        $reservas = $this->model->getMesasDisponiblesYReservadas($local, $fecha, $hora);

        header('Content-Type: application/json');
        echo json_encode($reservas);
    }
}