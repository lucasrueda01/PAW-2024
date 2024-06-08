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
            $local_id = $this->request->get('local');
            $fecha = $this->request->get('date');
            $hora_inicio = $this->request->get('time');
            $mesa_nombre = $this->request->get('nromesa-elegida');
    
            $local = new Local([], $this->qb);
            $mesa = new Mesa([], $this->qb);
            $reserva = new Reserva([], $this->qb);
    
            try {
                $local->load($local_id);
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
                        $reserva = [
                            "id" => $idGenerado,
                            "nombre" => $nombre,
                            "dni" => $dni,
                            "local" => $local->getNombre(),
                            "fecha" => $fecha,
                            "hora_inicio" => $hora_inicio,
                            "nombre_mesa" => $mesa_nombre,
                            "limite_reserva" => $hora_fin
                        ];
                        $resultado = [
                            "success" => true,
                            "message" => "Reserva realizada con éxito. Puede ver su reserva en Mis Reservas dentro de su perfil, o haciendo clic aquí."
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
    
            // Redirigir después de procesar el formulario
            header('Location: /reservar_cliente?success=' . $resultado['success'] . '&message=' . urlencode($resultado['message']));
            exit;
        }
    
        // Mostrar resultado si está presente
        if (isset($_GET['success']) && isset($_GET['message'])) {
            $resultado = [
                "success" => filter_var($_GET['success'], FILTER_VALIDATE_BOOLEAN),
                "message" => $_GET['message']
            ];
        }
    
        require $this->viewsDirCliente . 'reservar_cliente.view.php';
    }
    

    public function verMiReserva()
    {
        global $log;
    
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
    
        // Obtener userId
        $userId = $this->usuario->getUserId();
    
        // Obtener la última reserva del usuario
        $reserva = $this->model->getLastReservation($userId);
        $mesa = new Mesa([], $this->qb);
        $mesa->load($reserva['mesa_id']);
        
        $reserva['nombre_mesa'] = $mesa->getNombre();
        $log->info("reserva: ",[$reserva]);
        // Pasar la reserva a la vista
        require $this->viewsDir . 'mi_reserva.view.php';
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