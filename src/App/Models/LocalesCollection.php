<?php 


namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\App\Models\Plato;

class LocalesCollection extends Model
{
    public $table = 'local';

    public function getAll()
    {

        // crear tantos autor como filas de la tabla autores
        $locales = $this->queryBuilder->select($this->table);        

        $localCollection = [];
        foreach ($locales as $local)
        {
            $newLocal = new Plato;
            $newLocal->set($local);
            $localCollection[] = $newLocal;
        }

        return $localCollection;
    }

    public function get($id)
    {
        $local = new Local;
        $local->setQueryBuilder($this->queryBuilder);
        $result = $local->load($id);
        return [$result, $local];
    }


}
