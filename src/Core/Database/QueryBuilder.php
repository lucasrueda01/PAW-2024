<?php 

namespace Paw\Core\Database;

use PDO;
use Monolog\Logger;

class QueryBuilder 
{
    public PDO $pdo;
    public Logger $logger;

    public function __construct(PDO $pdo, Logger $logger = null)
    {   
        $this->pdo = $pdo;
        $this->logger = $logger;
    }

    public function select($table, $params = [])
    {   
        $where = "1 = 1";
        if(isset($params['id'])){
            $where = "id = :id ";
        }
        
        
        $query = "select * from {$table} where {$where}";    
        $sentencia = $this->pdo->prepare($query);
        
        if(isset($params['id'])){
            
            $sentencia->bindValue(":id", $params['id']);
        }

        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }

    public function insert()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}