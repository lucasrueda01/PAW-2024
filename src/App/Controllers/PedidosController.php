<?php

namespace Paw\App\Controllers;

use Paw\App\Utils\Verificador;

use Paw\Core\Controller;

use Paw\App\Models\PedidosCollection;

class PedidosController extends Controller
{

    public ?string $modelName = PedidosCollection::class;

    public Verificador $verificador;

    public function __construct()
    {
        parent::__construct();

        $this->verificador = new Verificador;
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
        require $this->viewsDirCliente . 'pedir.view.php';
    }

    public function get()
    {
        global $request;

        $id = $request->get('id');

        $pedido = $this->model->getById($id);

        $listaAcciones = PedidosCollection::$accionesPorEstado; //
        $urlsAccion = PedidosCollection::$urlsAccion;

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
        global $request;

        // Obtener la fecha y hora actual
        $fechaHora = date('Y-m-d\TH:i:s');

        // Obtener los artículos de la superglobal $_COOKIE
        $articulos = [];
        if (isset($_COOKIE['platos'])) {
            $articulos = json_decode($_COOKIE['platos'], true);
        }

        // Crear el nuevo pedido
        $nuevoPedido = [
            "Fecha/Hora" => $fechaHora,
            "Tipo" => $request->get("tipo"),
            "Nombre" => $request->get("nombre"),
            "Metodo de Pago" => $request->get("forma-de-pago"),
            "Direccion" => $request->get("direccion"),
            "Observaciones" => $request->get("observaciones"),
            "Monto Total" => $request->get("monto-total"),
            "articulos" => $articulos
        ];

        // Agregar el nuevo pedido a la colección
        $resultado = $this->model->new($nuevoPedido);

        // Redirigir o mostrar el resultado
        if (isset($resultado['exito'])) {
            $pedido = $this->model->getById($resultado['id']);
            $listaAcciones = PedidosCollection::$accionesPorEstado; //
            $urlsAccion = PedidosCollection::$urlsAccion;
        } 
        require $this->viewsDir . 'empleado/pedido.show.view.php';
        
    }
}