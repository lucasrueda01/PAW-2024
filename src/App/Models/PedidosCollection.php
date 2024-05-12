<?php 


namespace Paw\App\Models;

use Paw\Core\Model;


class PedidosCollection extends Model
{
    public $indice = [];
    static public $accionesPorEstado = [
        "sin-confirmar" => ["confirmar", "rechazar"],
        "confirmado" => ["despachar", "pasar-a-retirar"],
        "rechazado" => [],
        "despachado" => [],
        "pasar-a-retirar" => [],
        "en-preparacion" => ["finalizar", "cancelar"],
        "finalizado" => ["despachar", "pasar-a-retirar"]
    ];

    static public $urlsAccion  = [
        "confirmar" => "confirmado",
        "rechazar" => "rechazado",
        "finalizar" => "finalizado",
        "cancelar" => "cancelado",
        "despachar" => "despachado",        
        "pasar-a-retirar" => "pasar-a-retirar"
    ];

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

    public function modificarEstado($id, $estado)
    {
    // Leer el contenido del archivo JSON y convertirlo en un array PHP
    $json_data = file_get_contents(__DIR__ . '\listaPedidos.json');
    $pedidos = json_decode($json_data, true);

    // Buscar el pedido con el ID proporcionado
    $pedidoEncontrado = false;
    foreach ($pedidos as &$pedido) {
        if ($pedido['Nro Pedido'] == $id) {
            // Modificar el estado del pedido
            $pedido['Estado'] = $estado;
            $pedidoEncontrado = true;
            break; // Salir del bucle una vez que se haya encontrado el pedido
        }
    }

    // Verificar si se encontró el pedido
    if ($pedidoEncontrado) {
        // Convertir el array modificado a JSON
        $json_data = json_encode($pedidos, JSON_PRETTY_PRINT);

        // Guardar el JSON modificado en el archivo
        file_put_contents(__DIR__ . '\listaPedidos.json', $json_data);

        return ["exito" => "El estado del pedido con ID $id ha sido modificado a '$estado'."];
    } else {
        return ["error" => "No se encontró un pedido con el ID $id."];
    }

    }
 
}


