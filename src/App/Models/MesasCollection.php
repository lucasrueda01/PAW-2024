<?php 


namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\App\Models\Mesa;

class MesasCollection extends Model
{
    public $table = 'mesa';

    public $idLocal = null;

    public function __construct($idLocal=null)
    {
        $this->idLocal = $idLocal;
    }

    public function getIdLocal()
    {
        return $this->idLocal;
    }

    public function getAll()
    {
        try {
            // Realizar la consulta
            $mesas = $this->queryBuilder->select($this->table, ['local' => $this->getIdLocal()]);
            
            // Mostrar la consulta realizada
            $this->logger->info("Consulta realizada: " . $this->queryBuilder->getLastQuery());
    
            return $mesas;
            
        } catch (\Exception $e) {
            
            $this->logger->info("Error al obtener todas las mesas: " . $e->getMessage());


            return null; // Otra acción adecuada para manejar el error
        }
    }

    public function get($id)
    {
        $local = new Local;
        $local->setQueryBuilder($this->queryBuilder);
        $result = $local->loadByName($id);
        return [$result, $local];
    }


}
