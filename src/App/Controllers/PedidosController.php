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
        
        require $this->viewsDir . 'cliente/estado_pedido.view.php';
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
}