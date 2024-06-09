<?php

namespace Paw\App\Controllers;

use Paw\App\Utils\Verificador;

use Paw\Core\Controller;
use Paw\App\Models\Plato;

use Paw\App\Models\PedidosCollection;
use Paw\App\Controllers\UsuarioController;

class PedidosController extends Controller
{

    public ?string $modelName = PedidosCollection::class;

    public Verificador $verificador;
    public $usuario;
    public $data;

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

    public function pedidos_entrantes()
    {
        global $log;
    
        // Verificar si el usuario es empleado
        if ($this->usuario->getUserType() !== 'empleado') {
            // Log the unauthorized access attempt
            $log->info('Acceso no autorizado a pedidos entrantes.');
            
            // Mostrar página de error 404
            http_response_code(404);
            require $this->viewsDir . 'errors/not-found.view.php';
            return;
        }
    
        $titulo = 'PAW POWER | PEDIDOS';
    
        // Obtener todos los pedidos
        $pedidos = $this->model->getAll();
    
        $log->info("Pedidos: ",[$pedidos]);
        // Enviar a la vista de pedidos entrantes
        require $this->viewsDir . 'empleado/pedidos_entrantes.view.php';
    }

    public function pedir()
    {
        $titulo = 'PAW POWER | PEDIR';
        require $this->viewsDir . 'pedir.view.php';
    }

    public function verPedido()
    {
        global $log;
    
        // Verificar si hay sesión iniciada
        if (!$this->usuario->isUserLoggedIn()) {
            $resultado = [
                "success" => false,
                "message" => "Debe iniciar sesión para ver el pedido."
            ];
            $log->info("Intento de ver pedido sin sesión iniciada.");
            require $this->viewsDir . 'inicio_sesion.view.php'; // Redirigir a la página de inicio de sesión
            return;
        }
    
        // Obtener el ID del usuario desde la sesión
        $idUser = $this->usuario->getUserId();
    
        // Obtener el ID del pedido desde el parámetro de la URL
        $idPedido = $this->request->get('id');
    
        $log->info("Usuario ID: ", [$idUser]);
        $log->info("Tipo Usuario: ", [$this->usuario->getUserType()]);
        $log->info("Pedido ID: ", [$idPedido]);
    
        // Verificar el tipo de usuario
        $userType = $this->usuario->getUserType();
        if ($userType === 'empleado') {
            // El usuario es empleado, recuperar el pedido sin verificar el usuario
            if (is_null($idPedido)) {
                $log->info("ID de pedido no proporcionado.");
                http_response_code(404);
                require $this->viewsDir . 'errors/not-found.view.php';
                return;
            }
            $pedido = $this->model->getById(intval($idPedido));
        } elseif ($userType === 'cliente') {
            // El usuario es cliente
            if (is_null($idPedido)) {
                // Si no hay ID de pedido proporcionado, recuperar el último pedido del cliente
                $pedido = $this->model->getLastPedidoByUserId(intval($idUser));
                if (isset($pedido['error'])) {
                    $log->info("Error al obtener el último pedido: ", [$pedido['error']]);
                    http_response_code(404);
                    require $this->viewsDir . 'errors/not-found.view.php';
                    return;
                }
                $idPedido = $pedido['id'];
            } else {
                // Recuperar el pedido verificando que le pertenece al cliente
                $pedido = $this->model->getPedidoByUserAndId(intval($idUser), intval($idPedido));
                if (isset($pedido['error'])) {
                    $log->info("Error al obtener pedido: ", [$pedido['error']]);
                    http_response_code(404);
                    require $this->viewsDir . 'errors/not-found.view.php';
                    return;
                }
            }
        } else {
            // Tipo de usuario no autorizado, mostrar página de error 404
            $log->info('Tipo de usuario no autorizado.');
            http_response_code(404);
            require $this->viewsDir . 'errors/not-found.view.php';
            return;
        }
    
        $tipo = $this->usuario->getUserType();
        $listaAcciones = PedidosCollection::$accionesPorEstadoXTipoUsuario;
        $urlsAccion = PedidosCollection::$urlsAccion;
    
        $log->info("Pedido recuperado: ", [$pedido]);
    
        // Mostrar la vista del pedido
        require $this->viewsDir . 'empleado/pedido.show.view.php';
    }


    public function actualizarEstado()
    {
        global $log;
        try {
            // Obtener los datos del pedido del request
            $pedidoId = $this->request->get('id');
            $estadoActual = $this->request->get('estado');
    
            // Llamar al método actualizarEstado de la colección de pedidos
            list($nextStatus, $nextStatusId, $nextStatusProxName, $nextStatusIdProx) = $this->model->actualizarEstado($pedidoId, $estadoActual);
    
            $log->info("nextStatus: ",[$nextStatus]);
    
            // Devolver el próximo estado como respuesta con el header Content-Type
            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode([  'next_status' => $nextStatus, 
                                'next_status_id' => $nextStatusId, 
                                'next_status_to_next_status' => $nextStatusProxName,
                                'next_status_to_next_status_id' => $nextStatusIdProx,
                            ]);
        } catch (\Exception $e) {
            // Capturar excepción y manejarla
            http_response_code(500); // Error interno del servidor
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function get()
    {
        global $log;

        $id = $this->request->get('id');

        $log->info("id: ", [$id]);

        $pedido = $this->model->getById(intval($id));


        $tipo = $this->usuario->getUserType();
        $listaAcciones = PedidosCollection::$accionesPorEstadoXTipoUsuario; //
        $urlsAccion = PedidosCollection::$urlsAccion;

        $log->info("metodo getById: ", [$pedido]);

        if(isset($pedido['error'])){
            $resultado['error'] = $pedido['error'];
        }

        require $this->viewsDir . 'empleado/pedido.show.view.php';
    }

    public function getEstado()
    {
        $id = $this->request->get('id');

        $pedido = $this->model->getById($id);

        // Convertir el array a formato JSON
        $json_pedido = json_encode($pedido);    
        echo $json_pedido;
    }

    public function modificarEstado()
    {
        global $request;

        // Verificar si se recibieron los parámetros esperados
        if ($this->request->get('id') != null && $this->request->get('estado') != null) {
            $id = $this->request->get('id');
            $estado = $this->request->get('estado');
            $pedido = $this->model->modificarEstado($id, $estado);

            isset($pedido['error']) ? $error['description'] = $pedido['error'] : null;
        } else {
            // Si no se recibieron los parámetros esperados, mostrar un mensaje de error
            $error['description'] = "Error: Debes proporcionar los parámetros 'id' y 'estado' en la URL.";
        }
        $pedidos = $this->model->getAll();
        require $this->viewsDir . 'empleado/pedidos_entrantes.view.php';
    }

    public function new()
    {
        global $log;

        // Obtener la fecha y hora actual
        $fechaHora = date('Y-m-d\TH:i:s');


        $log->info("isUserLoggedIn :", [$this->usuario->isUserLoggedIn()]);
        $articulos = [];
        // Verificar si hay sesión iniciada
        $this->usuario->verificarSesion();
 

        if (!is_null($this->request->get('carrito_data'))) {
            $carrito = json_decode($request->get('carrito_data'), true);
            
            $total = 0;

            foreach ($carrito['platos'] as $plato) {

                $id = intval($plato['id']);
                $cantidad = intval($plato['cantidad']);

                if($cantidad > 0){

                    $log->info("id, cantidad :", [$id, $cantidad]);

                    $platoPedido = new Plato;
                    $platoPedido->setQueryBuilder($this->qb);
                    $platoPedido->load($id);

                    $subtotal = $platoPedido->getPrecio() * $cantidad;

                    $articulos[] = [
                        "nombre_articulo" => $platoPedido->getNombrePlato(),
                        "precio"  => floatval($platoPedido->getPrecio()),
                        "cantidad" => $cantidad,
                        "subtotal" => $subtotal,
                    ];
                    $total = $total + $subtotal;
                }
            }
        }

        // Preparar los datos del pedido
        $datosPedido = [
            "fecha_hora" => $fechaHora,
            "tipo" => $this->request->get("tipo"),
            "id_usuario" => $this->usuario->getUserId(),
            "metodo_pago" => $this->request->get("forma-de-pago"),
            "direccion" => htmlspecialchars($this->request->get("direccion")),
            "observaciones" => htmlspecialchars($this->request->get("observaciones")),
            "monto_total" => $total,
            "estado" => "sin-confirmar"
        ];

        // Verificar si $datosPedido es JSON y convertirlo a array si es necesario
        if (is_string($datosPedido)) {
            $datosPedido = json_decode($datosPedido, true);
        }

        // Verificar si $articulos es JSON y convertirlo a array si es necesario
        if (is_string($articulos)) {
            $articulos = json_decode($articulos, true);
        }        

        $log->info("datosPedido, articulos: ",[$datosPedido, $articulos]);
        // Insertar el nuevo pedido utilizando PedidosCollection
        $resultadoInsercion = $this->model->new($datosPedido, $articulos);

        // Verificar el resultado de la inserción
        if ($resultadoInsercion !== false) {
            $this->verPedido();
            // Hacer algo con el ID del pedido generado
        } else {
            // Manejar el caso en que ocurrió un error al insertar el pedido
        }
    }
}