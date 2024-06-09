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
        global $log;
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

                $log->info("pedido: " , [$pedido]);
                
                // Obtener el estado actual del pedido
                $estadoActual = $pedido['estado_id'];

                // Obtener el próximo estado del pedido usando QueryBuilder
                
                $pedido['current_status'] = $this->getOrderStatus($estadoActual);                
                
                list($pedido['next_status'], $pedido['next_status_id']) = $this->getNextStatus($estadoActual);


                $log->info("Estados variables: ", [$estadoActual, $pedido['current_status'], $pedido['next_status']]);
            }

            return $pedidos;
        } catch (\Exception $e) {
            if ($this->logger) {
                $this->logger->error("Error al recuperar los pedidos: " . $e->getMessage());
            }
            return ['error' => $e->getMessage()];
        }
    }

    public function getOrderStatus($estatusId)
    {
        try {

            $estado = $this->queryBuilder->select('estado_pedido', ['id' => $estatusId]);
    
            // Verificar si se encontró el estado
            if (empty($estado)) {
                throw new \Exception('Estado del pedido no encontrado en la base de datos.');
            }
    
            // Devolver el nombre del estado actual
            return $estado[0]['status_name'];

        } catch (\Exception $e) {
            if ($this->logger) {
                $this->logger->error("Error al recuperar el estado del pedido: " . $e->getMessage());
            }
            return ['error' => $e->getMessage()];
        }
    }    

    private function getNextStatus($currentStatusId)
    {
        // Obtener el estado actual de la tabla estado_pedido
        $currentStatus = $this->queryBuilder->select('estado_pedido', ['id' => $currentStatusId]);
    
        if (empty($currentStatus)) {
            throw new \Exception('Estado actual no encontrado en la tabla estado_pedido.');
        }
    
        // Obtener el próximo estado, asumiendo que el próximo estado tiene el siguiente id
        // Si tu lógica para determinar el próximo estado es diferente, deberás ajustarla aquí
        $nextStatusId = $currentStatusId + 1;
        $nextStatus = $this->queryBuilder->select('estado_pedido', ['id' => $nextStatusId]);
    
        // Verificar si se encontró el próximo estado
        if (empty($nextStatus)) {
            return [null, null]; // No hay próximo estado disponible
        }
    
        return [$nextStatus[0]['status_name'],$nextStatus[0]['id']];
    }

    public function actualizarEstado($pedidoId, $estadoActual)
    {
        try {
            // Obtener el próximo estado del pedido
            list($nextStatus, $nextStatusId) = $this->getNextStatus($estadoActual);

            // Verificar si se obtuvo el próximo estado
            if (!$nextStatus) {
                throw new \Exception('No se pudo obtener el próximo estado del pedido.');
            }

            // Realizar la actualización del estado en la base de datos
            $updateResult = $this->queryBuilder->update('pedidos', ['estado_id' => $nextStatusId], ['id' => $pedidoId]);

            // Verificar si la actualización fue exitosa
            if ($updateResult) {
                // Devolver el próximo estado como respuesta
                return $nextStatus;
            } else {
                throw new \Exception('Error al actualizar el estado del pedido en la base de datos.');
            }
        } catch (\Exception $e) {
            // Manejar cualquier error que ocurra
            return $e->getMessage();
        }
    }


    public function getById($idPedido)
    {
        try {
            // Obtener el pedido por ID
            $pedidos = $this->queryBuilder->select('pedidos', ['id' => $idPedido]);
    
            // Verificar si se encontró el pedido
            if (empty($pedidos)) {
                return ['error' => 'No se encontró ningún pedido con ese ID.'];
            }
    
            $pedido = $pedidos[0];
    
            // Obtener los artículos asociados a este pedido
            $articulos = $this->queryBuilder->select('detalle_pedidos', ['id_pedido' => $pedido['id']]);
            $pedido['articulos'] = $articulos;
    
            return $pedido;
        } catch (\Exception $e) {
            if ($this->logger) {
                $this->logger->error("Error al recuperar el pedido: " . $e->getMessage());
            }
            return ['error' => $e->getMessage()];
        }
    }

    public function getPedidoByUserAndId($idUser, $idPedido)
    {
        try {
            // Recuperar el pedido por ID y ID de usuario
            $pedido = $this->queryBuilder->select('pedidos', ['id' => $idPedido, 'id_usuario' => $idUser]);
    
            if (empty($pedido)) {
                return ['error' => 'Pedido no encontrado o no pertenece al usuario.'];
            }
    
            $pedido = $pedido[0]; // Asumiendo que select retorna un array de resultados
    
            // Recuperar los artículos asociados a este pedido
            $articulos = $this->queryBuilder->select('detalle_pedidos', ['id_pedido' => $idPedido]);
            $pedido['articulos'] = $articulos;
    
            return $pedido;
        } catch (\Exception $e) {
            if ($this->logger) {
                $this->logger->error("Error al recuperar el pedido: " . $e->getMessage());
            }
            return ['error' => $e->getMessage()];
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


