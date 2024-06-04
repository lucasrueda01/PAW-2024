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
        
        $query = "select * from {$table} where {$where}";    

        // $this->logger->info($query);

        $sentencia = $this->pdo->prepare($query);
        
        if(isset($params['id'])){
            
            // Construir la consulta SQL con la condición WHERE
            $query = "SELECT * FROM {$table} WHERE {$where}";    
    
            // Loggear la consulta SQL
            $this->logger->info($query);
        
            // Preparar la consulta SQL
            $sentencia = $this->pdo->prepare($query);
            
            // Asignar valores a los parámetros de la consulta
            if(isset($params['id'])){
                $sentencia->bindValue(":id", $params['id']);
            }
    
            // Asignar valores a los parámetros de la consulta para la búsqueda por nombre de usuario
            if(isset($params['username'])){
                $sentencia->bindValue(":username", $params['username']);
            }
        
            // Establecer el modo de recuperación de datos y ejecutar la consulta
            $sentencia->setFetchMode(PDO::FETCH_ASSOC);
            $sentencia->execute();
            
            // Obtener los resultados de la consulta
            $resultadoConsulta = $sentencia->fetchAll();
    
            // Loggear los resultados de la consulta
            $this->logger->info("resultadoConsulta: ", [$resultadoConsulta]);
    
            // Devolver los resultados de la consulta
            return $resultadoConsulta;
        } catch (PDOException $e) {
            // Capturar excepción y manejarla
            $this->logger->error("Error al ejecutar la consulta: " . $e->getMessage());
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


    public function update()
    {

    }

    public function delete()
    {

    }
}