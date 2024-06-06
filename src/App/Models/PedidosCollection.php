<?php 


namespace Paw\App\Models;

use Paw\Core\Model;
use Exception;
use Paw\App\Controllers\UsuarioController;

class PedidosCollection extends Model
{
    public $indice = [];

    static public $accionesPorEstadoXTipoUsuario = [
        "cliente" => [
            "sin-confirmar" => ["cancelar"],    
            "confirmado" => ["cancelar"],
            "despachado" => [],
            "cancelado" => [],
            "pasar-a-retirar" => [],
            "en-preparacion" => ["cancelar"],
            "finalizado" => []
        ],
        "empleado" => [
            "sin-confirmar" => ["confirmar", "rechazar"],
            "confirmado" => ["despachar", "pasar-a-retirar"],
            "rechazado" => [],
            "despachado" => [],
            "cancelado" => [],
            "pasar-a-retirar" => [],
            "en-preparacion" => ["finalizar", "cancelar"],
            "finalizado" => ["despachar", "pasar-a-retirar"]
        ]
    ];
    static public $urlsAccion  = [
        "confirmar" => "confirmado",
        "rechazar" => "rechazado",
        "finalizar" => "finalizado",
        "cancelar" => "cancelado",
        "despachar" => "despachado",        
        "pasar-a-retirar" => "pasar-a-retirar"
    ];
    public $usuario;

    public function __construct()
    {
        // Leer el contenido del archivo JSON y convertirlo en un array de pedidos
        $json_data = file_get_contents( __DIR__ . '\listaPedidos.json');
        $pedidos = json_decode($json_data, true);

        // indexar los pedidos por su número de pedido        
       
        foreach ($pedidos as $pedido) {
            $this->indice[$pedido['Nro Pedido']] = $pedido;
        }
            
        $this->usuario = new UsuarioController();

    }

    // public function getAll()
    // {
    //     // Leer el contenido del archivo JSON
    //     $json_data = file_get_contents( __DIR__ . '\listaPedidos.json');

    //     // Convertir el JSON 
    //     $pedidosCollection = json_decode($json_data, true);

    //     // Verificar si la decodificación fue exitosa
    //     if ($pedidosCollection === null) {
    //         echo "Error al decodificar el archivo JSON.";
    //     } else {
    //         return $pedidosCollection;
    //     }
    // }

    public function getAll()
    {
        try {
            // Obtener todos los pedidos usando QueryBuilder
            $pedidos = $this->queryBuilder->select('pedidos');

            // Verificar si se obtuvieron los pedidos
            if ($pedidos === false) {
                throw new \Exception('Error al recuperar los pedidos de la base de datos.');
            }

            // Formatear cada pedido para incluir sus artículos
            foreach ($pedidos as &$pedido) {
                // Obtener los artículos asociados a este pedido
                $articulos = $this->queryBuilder->select('detalle_pedidos', ['id_pedido' => $pedido['id']]);
                $pedido['articulos'] = $articulos;
            }

            return $pedidos;
        } catch (\Exception $e) {
            if ($this->logger) {
                $this->logger->error("Error al recuperar los pedidos: " . $e->getMessage());
            }
            return ['error' => $e->getMessage()];
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

        
        if(!isset(self::$accionesPorEstadoXTipoUsuario[$this->usuario->getUserType()][$estado])){
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

    public function getLastPedidoByUserId($idUser)
    {
        try {
            // Recuperar el último pedido del usuario utilizando el QueryBuilder
            $pedidos = $this->queryBuilder->selectWithOrderAndLimit('pedidos', ['id_usuario' => $idUser], 'created_at', 'DESC', 1);
    
            if ($pedidos) {
                $pedido = $pedidos[0]; // El pedido más reciente
    
                // Recuperar los artículos asociados a este pedido
                $articulos = $this->queryBuilder->select('detalle_pedidos', ['id_pedido' => $pedido['id']]);
    
                $pedido['articulos'] = $articulos;
                return $pedido;
            } else {
                return ['error' => 'No se encontró ningún pedido para este usuario.'];
            }
        } catch (\Exception $e) {
            if ($this->logger) {
                $this->logger->error("Error al recuperar el pedido: " . $e->getMessage());
            }
            return ['error' => $e->getMessage()];
        }
    }
    

    public function new($datosPedido, $articulos)
    {
        try {
            global $log;
            // Insertar el nuevo pedido en la tabla 'pedidos'

            [$idPedidoGenerado, $resultado] = $this->queryBuilder->insert('pedidos', $datosPedido);
    
            if ($resultado) {
                // Insertar los artículos del pedido en la tabla 'pedido_articulos'
                foreach ($articulos as $articulo) {
                    $articulo['id_pedido'] = $idPedidoGenerado;
                    $this->queryBuilder->insert('detalle_pedidos', $articulo);
                }
                return [$idPedidoGenerado, $resultado];
            } else {
                throw new \Exception("Error al insertar el pedido.");
            }
        } catch (\Exception $e) {
            if ($this->logger) {
                $this->logger->error("Error al crear el pedido: " . $e->getMessage());
            }
            return false;
        }
    }
}


