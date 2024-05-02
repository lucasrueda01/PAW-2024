<?php 

namespace Paw\Core\Database;

use PDO;
use Monolog\Logger;

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
        $where = "";
        $bindings = [];
    
        foreach ($params as $key => $value) {
            if ($where !== "") {
                $where .= " AND ";
            }
            $where .= "$key = :$key";
            $bindings[":$key"] = $value;
        }
    
        // Construir la consulta
        $query = "SELECT * FROM $table";
        if ($where !== "") {
            $query .= " WHERE $where";
        }      
    
        $this->lastQuery = $query;

        $this->logger->info($this->lastQuery);

        $sentencia = $this->pdo->prepare($query);
        
        $this->logger->info($sentencia);
        
        // Vincular los parámetros
        foreach ($bindings as $key => $value) {
            $sentencia->bindValue($key, $value);
        }
    
        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $sentencia->execute();
        return $sentencia->fetchAll();
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