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
        $plato->load($id);
        return $plato;
    }

    public function insert($datosPlato)
    {
        // $this->logger->info("Inserting", [$this->fields]);
        global $log;

        $newPlato = new Plato;
        $newPlato->setQueryBuilder($this->queryBuilder);
        $newPlato->set($datosPlato);

        $log->info("queryBuilder [insertPlato]: ", [$newPlato]);

        $resultado = $this->queryBuilder->insert($this->table, $newPlato->getAllFields());

        $log->info("resultado insert: ", [$resultado]);

        return $resultado;
    }    
}
