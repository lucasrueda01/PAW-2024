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
        $titulo = 'PAW POWER | PEDIDOS';

        $pedidos = $this->model->getAll();

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
                "message" => "Debe iniciar sesión para ver su pedido."
            ];
            $log->info("Intento de ver pedido sin sesión iniciada.");
            require $this->viewsDirCliente . 'login.view.php'; // Redirigir a la página de inicio de sesión
            return;
        }
    
        // Obtener el ID del usuario desde la sesión
        $idUser = $this->usuario->getUserId();
    
        $log->info("Usuario ID: ", [$idUser]);
    
        // Recuperar el último pedido asociado al ID del usuario
        $pedido = $this->model->getLastPedidoByUserId(intval($idUser));
    
        $tipo = $this->usuario->getUserType();
        $listaAcciones = PedidosCollection::$accionesPorEstadoXTipoUsuario;
        $urlsAccion = PedidosCollection::$urlsAccion;
    
        $log->info("Método getLastPedidoByUserId: ", [$pedido]);
    
        if (isset($pedido['error'])) {
            $resultado['error'] = $pedido['error'];
        }
    

        require $this->viewsDir . 'empleado/pedido.show.view.php';
    }
    

    public function get()
    {
        global $request, $log;

        $id = $request->get('id');

        $log->info("id: ", [$id]);

        $pedido = $this->model->getById(intval($id));


        $tipo = $this->usuario->getUserType();
        $listaAcciones = PedidosCollection::$accionesPorEstadoXTipoUsuario; //
        $urlsAccion = PedidosCollection::$urlsAccion;

        $log->info("metodo getById: ", [$pedido]);

        if(isset($pedido['error'])){
            $resultado['error'] = $pedido['error'];
        }

        // var_dump($pedido);
        // echo("<pre>");
        require $this->viewsDir . 'empleado/pedido.show.view.php';
    }

    public function getEstado()
    {
        global $request;

        $id = $request->get('id');

        $pedido = $this->model->getById($id);

        // Convertir el array a formato JSON
        $json_pedido = json_encode($pedido);    
        echo $json_pedido;
    }

    public function modificarEstado()
    {
        global $request;

        // Verificar si se recibieron los parámetros esperados
        if ($request->get('id') != null && $request->get('estado') != null) {
            $id = $request->get('id');
            $estado = $request->get('estado');
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
        global $request, $log;

        // Obtener la fecha y hora actual
        $fechaHora = date('Y-m-d\TH:i:s');


        $log->info("isUserLoggedIn :", [$this->usuario->isUserLoggedIn()]);
        $articulos = [];
        // Verificar si hay sesión iniciada
        if (!$this->usuario->isUserLoggedIn()) {
            $resultado = [
                "success" => false,
                "message" => "Debe iniciar sesión para realizar una reserva."
            ];
            $log->info("Intento de pedido sin sesión iniciada.");
            require $this->viewsDir . 'nuestro_menu.view.php';
            return;
        }

        if (!is_null($request->get('carrito_data'))) {
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
            "tipo" => $request->get("tipo"),
            "id_usuario" => $this->usuario->getUserId(),
            "metodo_pago" => $request->get("forma-de-pago"),
            "direccion" => htmlspecialchars($request->get("direccion")),
            "observaciones" => htmlspecialchars($request->get("observaciones")),
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