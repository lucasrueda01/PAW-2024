<?php 

namespace Paw\Core\Database;

use PDO;
use Monolog\Logger;
use PDOException;

class QueryBuilder 
{
    public PDO $pdo;
    public Logger $logger;
    private $lastQuery;

    public function __construct(PDO $pdo, Logger $logger = null)
    {   
        $this->pdo = $pdo;
        $this->logger = $logger;
    }

    public function select($table, $params = []) {
        try {
            // Inicializar la condición WHERE
            $where = "1 = 1";
    
            // Añadir condiciones según los parámetros
            $whereConditions = [];
            $bindParams = [];
    
            foreach ($params as $key => $value) {
                $whereConditions[] = "$key = :$key";
                $bindParams[":$key"] = $value;
            }
    
            if (!empty($whereConditions)) {
                $where = implode(' AND ', $whereConditions);
            }
    
            // Construir la consulta SQL con la condición WHERE
            $query = "SELECT * FROM {$table} WHERE {$where}";
    
            // Loggear la consulta SQL
            if ($this->logger) {
                $this->logger->info($query);
            }
    
            // Preparar la consulta SQL
            $sentencia = $this->pdo->prepare($query);
    
            // Asignar valores a los parámetros de la consulta
            foreach ($bindParams as $param => $value) {
                $sentencia->bindValue($param, $value);
            }
    
            // Establecer el modo de recuperación de datos y ejecutar la consulta
            $sentencia->setFetchMode(PDO::FETCH_ASSOC);
            $sentencia->execute();
    
            // Obtener los resultados de la consulta
            $resultadoConsulta = $sentencia->fetchAll();
    
            // Loggear los resultados de la consulta
            // if ($this->logger) {
            //     $this->logger->info("resultadoConsulta: ", [$resultadoConsulta]);
            // }
    
            // Devolver los resultados de la consulta
            return $resultadoConsulta;
        } catch (PDOException $e) {
            // Capturar excepción y manejarla
            if ($this->logger) {
                $this->logger->error("Error al ejecutar la consulta: " . $e->getMessage());
            }
            return false; // O devuelve un valor que indique que hubo un error
        }
        
    }

    public function insert($table, $data)
    {
        $columnas = implode(', ', array_keys($data));
        $valores = ':' . implode(', :', array_keys($data));
        $query = "INSERT INTO $table ($columnas) VALUES ($valores)";
        $sentencia = $this->pdo->prepare($query);
    
        // Asignar valores a los parámetros
        foreach ($data as $clave => $valor) {
            $sentencia->bindValue(":$clave", $valor);
        }
    
        $resultado = $sentencia->execute();
        
        $idGenerado = $this->pdo->lastInsertId();

        return [$idGenerado, $resultado];
    }

    public function getLastQuery()
    {
        return $this->lastQuery;
    }


    public function selectWithOrderAndLimit($table, $params = [], $orderBy = '', $orderDirection = 'ASC', $limit = null)
    {
        try {
            // Inicializar la condición WHERE
            $where = "1 = 1";
    
            // Añadir condiciones según los parámetros
            $whereConditions = [];
            $bindParams = [];
    
            foreach ($params as $key => $value) {
                $whereConditions[] = "$key = :$key";
                $bindParams[":$key"] = $value;
            }
    
            if (!empty($whereConditions)) {
                $where = implode(' AND ', $whereConditions);
            }
    
            // Construir la consulta SQL con la condición WHERE, ORDER BY y LIMIT
            $query = "SELECT * FROM {$table} WHERE {$where}";
            if ($orderBy) {
                $query .= " ORDER BY {$orderBy} {$orderDirection}";
            }
            if ($limit) {
                $query .= " LIMIT {$limit}";
            }
    
            // Loggear la consulta SQL
            if ($this->logger) {
                $this->logger->info($query);
            }
    
            // Preparar la consulta SQL
            $sentencia = $this->pdo->prepare($query);
    
            // Asignar valores a los parámetros de la consulta
            foreach ($bindParams as $param => $value) {
                $sentencia->bindValue($param, $value);
            }
    
            // Establecer el modo de recuperación de datos y ejecutar la consulta
            $sentencia->setFetchMode(PDO::FETCH_ASSOC);
            $sentencia->execute();
    
            // Obtener los resultados de la consulta
            $resultadoConsulta = $sentencia->fetchAll();
    
            // Loggear los resultados de la consulta
            if ($this->logger) {
                $this->logger->info("resultadoConsulta: ", [$resultadoConsulta]);
            }
    
            // Devolver los resultados de la consulta
            return $resultadoConsulta;
        } catch (PDOException $e) {
            // Capturar excepción y manejarla
            if ($this->logger) {
                $this->logger->error("Error al ejecutar la consulta: " . $e->getMessage());
            }
            return false; // O devuelve un valor que indique que hubo un error
        }
    }

    public function getMesasDisponiblesYReservadas($local, $fecha, $hora)
    {
        $this->logger->info("local, fecha hora: ",[$local, $fecha, $hora]);
        try {
            // Consulta SQL para obtener mesas disponibles y reservadas
            $query = "SELECT * FROM (
                        -- Consulta para mesas disponibles
                        SELECT m.id AS mesa_id, m.nombre AS nombre_mesa, 'disponible' AS estado
                        FROM mesas m
                        WHERE m.local_id = :local_id
                        AND m.id NOT IN (
                            SELECT r.mesa_id
                            FROM reservas r
                            WHERE r.fecha = :fecha
                            AND r.hora_inicio <= :hora
                            AND r.hora_fin > :hora
                            AND r.id_local = :local_id
                        )
                        
                        UNION ALL
                        
                        -- Consulta para mesas reservadas
                        SELECT r.mesa_id AS mesa_id, m.nombre AS nombre_mesa, 'reservada' AS estado
                        FROM reservas r
                        JOIN mesas m ON r.mesa_id = m.id
                        WHERE r.fecha = :fecha
                        AND r.hora_inicio <= :hora
                        AND r.hora_fin > :hora
                        AND r.id_local = :local_id
                    ) AS resultado;";
    
            // Preparar la consulta SQL
            $statement = $this->pdo->prepare($query);
    
            // Asignar valores a los parámetros de la consulta
            $statement->bindValue(':local_id', $local);
            $statement->bindValue(':fecha', $fecha);
            $statement->bindValue(':hora', $hora);
    
            // Ejecutar la consulta
            $statement->execute();
    
            // Obtener los resultados de la consulta
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    
            // Dividir las mesas disponibles y reservadas
            $mesasDisponibles = [];
            $mesasReservadas = [];
    
            foreach ($results as $mesa) {
                if ($mesa['estado'] === 'disponible') {
                    $mesasDisponibles[] = $mesa;
                } else {
                    $mesasReservadas[] = $mesa;
                }
            }
    
            // Devolver las mesas disponibles y reservadas
            return [
                'mesasDisponibles' => $mesasDisponibles,
                'mesasReservadas' => $mesasReservadas
            ];
        } catch (PDOException $e) {
            // Manejar la excepción si ocurre algún error
            if ($this->logger) {
                $this->logger->error("Error al ejecutar la consulta: " . $e->getMessage());
            }
            return false;
        }
    }
    public function update($table, $data, $conditions)
    {
        try {
            // Crear la cadena de actualización de columnas
            $setClause = '';
            foreach ($data as $key => $value) {
                $setClause .= "$key = :$key, ";
            }
            $setClause = rtrim($setClause, ', ');
    
            // Crear la cadena de condiciones WHERE
            $whereClause = '';
            foreach ($conditions as $key => $value) {
                $whereClause .= "$key = :$key AND ";
            }
            $whereClause = rtrim($whereClause, ' AND ');
    
            // Construir la consulta SQL
            $query = "UPDATE $table SET $setClause WHERE $whereClause";
    
            // Loggear la consulta SQL
            if ($this->logger) {
                $this->logger->info($query);
            }
    
            // Preparar la consulta SQL
            $statement = $this->pdo->prepare($query);
    
            // Asignar valores a los parámetros
            foreach ($data as $key => $value) {
                $statement->bindValue(":$key", $value);
            }
            foreach ($conditions as $key => $value) {
                $statement->bindValue(":$key", $value);
            }
    
            // Ejecutar la consulta
            $result = $statement->execute();
    
            // Devolver el resultado de la ejecución de la consulta
            return $result;
        } catch (PDOException $e) {
            // Capturar excepción y manejarla
            if ($this->logger) {
                $this->logger->error("Error al ejecutar la consulta: " . $e->getMessage());
            }
            return false;
        }
    }
}    


