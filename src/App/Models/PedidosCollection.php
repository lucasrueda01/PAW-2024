<?php 


namespace Paw\App\Models;

use Paw\Core\Model;
use Exception;


class PedidosCollection extends Model
{
    public $indice = [];
    static public $accionesPorEstado = [
        "sin-confirmar" => ["confirmar", "rechazar"],
        "confirmado" => ["despachar", "pasar-a-retirar"],
        "rechazado" => [],
        "despachado" => [],
        "cancelado" => [],
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

    public function getById($id)
    {
        global $log;
        
        try {
            // Verificar si el índice existe
            if (!isset($this->indice[$id])) {
                throw new Exception("NRO DE PEDIDO NO ENCONTRADO");
            }
    
            return $this->indice[$id];
        } catch (Exception $e) {
            // Manejar la excepción si el ID no existe en el índice
            $log->info("error: ", [$e->getMessage()]);
            return [
                "error" => "NRO DE PEDIDO NO ENCONTRADO. " . $e->getMessage()
            ];
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

        if(!isset(self::$accionesPorEstado[$estado])){
            return ["error" => "El estado para el pedido no esta permitido"];
        }
        // Convertir el array modificado a JSON
        $json_data = json_encode($pedidos, JSON_PRETTY_PRINT);

        // Guardar el JSON modificado en el archivo
        file_put_contents(__DIR__ . '\listaPedidos.json', $json_data);

        return ["exito" => "El estado del pedido con ID $id ha sido modificado a '$estado'."];
    } else {
        return ["error" => "No se encontró un pedido con el ID $id."];
    }

    }

    public function calcularMonto($articulos)
    {   

    }

    public function new($pedido)
    {
        try {
            // Leer el contenido del archivo JSON y convertirlo en un array PHP
            $json_data = file_get_contents(__DIR__ . '/listaPedidos.json');
            if ($json_data === false) {
                throw new \Exception("Error al leer el archivo JSON.");
            }

            $pedidos = json_decode($json_data, true);
            if ($pedidos === null) {
                throw new \Exception("Error al decodificar el archivo JSON.");
            }

            // Generar un nuevo número de pedido único
            $nuevoNroPedido = count($pedidos) + 1;
            while (isset($this->indice[$nuevoNroPedido])) {
                $nuevoNroPedido++;
            }

            // Añadir el nuevo número de pedido al pedido
            $pedido['Nro Pedido'] = $nuevoNroPedido;

            // Establecer el estado inicial del pedido
            $pedido['Estado'] = 'sin-confirmar';

            // Validar que los campos necesarios no estén vacíos
            if (empty($pedido['Fecha/Hora']) || empty($pedido['Tipo']) || empty($pedido['Metodo de Pago'])) {
                throw new \Exception("Faltan datos obligatorios para el pedido.");
            }

            // Añadir el nuevo pedido al array de pedidos
            $pedidos[] = $pedido;
            $this->indice[$nuevoNroPedido] = $pedido;

            // Convertir el array modificado a JSON
            $json_data = json_encode($pedidos, JSON_PRETTY_PRINT);
            if ($json_data === false) {
                throw new \Exception("Error al codificar los datos a JSON.");
            }

            // Guardar el JSON modificado en el archivo
            if (file_put_contents(__DIR__ . '/listaPedidos.json', $json_data) === false) {
                throw new \Exception("Error al guardar el archivo JSON.");
            }

            return [
                "exito" => "El nuevo pedido ha sido creado con éxito con el ID $nuevoNroPedido.",
                "id" => $nuevoNroPedido
            ];
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage()
            ];
        }
    }
}


