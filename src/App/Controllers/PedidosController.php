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

    public function __construct()
    {
        parent::__construct();

        $this->verificador = new Verificador;
        $usuario = new UsuarioController();
        list($this->menuPerfil, $this->menuEmpleado) = $usuario->adjustMenuForSession($this->menuPerfil, $this->menuEmpleado);    
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

    public function get()
    {
        global $request, $log;

        $id = $request->get('id');

        $log->info("id: ", [$id]);

        $pedido = $this->model->getById(intval($id));



        $listaAcciones = PedidosCollection::$accionesPorEstado; //
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
            $pedido = $this->model->modificarEstado($id, $estado, );

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

        // Obtener los artículos de la superglobal $_COOKIE
        $articulos = [];

        if (isset($_COOKIE['platos'])) {
            $datos = json_decode($_COOKIE['platos'], true);
            
            $total = 0;

            foreach ($datos as $item) {

                $id = intval($item['id']);
                $cantidad = intval($item['cantidad']);

                $log->info("id, cantidad :", [$id, $cantidad]);

                $platoPedido = new Plato;
                $platoPedido->setQueryBuilder($this->qb);
                $platoPedido->load($id);

                $subtotal = $platoPedido->getPrecio() * $cantidad;

                $articulos[] = [
                    "nombre" => $platoPedido->getNombrePlato(),
                    "precio"  => floatval($platoPedido->getPrecio()),
                    "cantidad" => $cantidad,
                    "subtotal" => $subtotal,
                ];
                $total = $total + $subtotal;
            }
        }

        // Crear el nuevo pedido
        $nuevoPedido = [
            "Fecha/Hora" => $fechaHora,
            "Tipo" => $request->get("tipo"),
            "Nombre" => htmlspecialchars($request->get("nombre")),
            "Metodo de Pago" => $request->get("forma-de-pago"),
            "Direccion" => htmlspecialchars($request->get("direccion")),
            "Observaciones" => htmlspecialchars($request->get("observaciones")),
            "Monto Total" => $total,
            "articulos" => $articulos,
        ];

        
        $log->info("articulos, total ,nuevoPedido :", [$articulos, $total ,$nuevoPedido]);

        // Agregar el nuevo pedido a la colección
        $resultado = $this->model->new($nuevoPedido);
        
        
        if (isset($resultado['exito'])) {
            $pedido = $this->model->getById($resultado['id']);

            $log->info("resultado['id']: ", [$resultado['id']]);

            $listaAcciones = PedidosCollection::$accionesPorEstado; //
            $urlsAccion = PedidosCollection::$urlsAccion;
        } 
        
        require $this->viewsDir . 'empleado/pedido.show.view.php';
        
    }
}