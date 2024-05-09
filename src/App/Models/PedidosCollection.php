<?php 


namespace Paw\App\Models;

use Paw\Core\Model;


class PedidosCollection extends Model
{
    public $indice = [];

    public function __construct()
    {
        // Leer el contenido del archivo JSON y convertirlo en un array de pedidos
        $json_data = file_get_contents( __DIR__ . '\listaPedidos.json');
        $pedidos = json_decode($json_data, true);

        // indexar los pedidos por su número de pedido        
       
        foreach ($pedidos as $pedido) {
            $this->indice[$pedido['Nro Pedido']] = $pedido;
        }
                
    }

    public function getAll()
    {
        // Leer el contenido del archivo JSON
        $json_data = file_get_contents( __DIR__ . '\listaPedidos.json');

        // Convertir el JSON 
        $pedidosCollection = json_decode($json_data, true);

        // Verificar si la decodificación fue exitosa
        if ($pedidosCollection === null) {
            echo "Error al decodificar el archivo JSON.";
        } else {
            return $pedidosCollection;
        }
    }

    public function getbyId($id)
    {
        // Verificar si la decodificación fue exitosa
        if (!isset($this->indice[$id])) {
            echo "Error al decodificar el archivo JSON.";
        } else {
            return $this->indice[$id];
        }

    }

 
}


