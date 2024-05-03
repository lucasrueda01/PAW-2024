<?php 


namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\App\Models\Plato;

class PlatosCollection extends Model
{
    public $table = 'plato';

    public function getAll()
    {
        // crear tantos autor como filas de la tabla autores
        $platos = $this->queryBuilder->select($this->table);

        $platosCollection = [];
        foreach ($platos as $plato)
        {
            $newPlato = new Plato;
            $newPlato->set($plato);
            $platosCollection[] = $newPlato;
        }

        return $platosCollection;
    }

    public function get($id)
    {
        $plato = new Plato;
        $plato->setQueryBuilder($this->queryBuilder);
        $result = $plato->load($id);
        return [$result, $plato];
    }

    public function insert($newPlato)
    {
        global $log;

        $log->info("queryBuilder [insertPlato]: ", [$newPlato]);

        list($idPlato, $resultado) = $this->queryBuilder->insert($this->table, $newPlato->getAllFields());

        $newPlato->setId($idPlato);
        
        $log->info("resultado insert: ", [$resultado, $idPlato]);

        return $resultado;
    }    
}
