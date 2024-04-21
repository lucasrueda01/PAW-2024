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
}
