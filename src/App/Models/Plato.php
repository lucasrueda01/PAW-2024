<?php 


namespace Paw\App\Models;

use Paw\Core\Model;

use Exception;
use Paw\Core\Exceptions\InvalidValueFormatException;

class Plato extends Model
{       
    public $table = 'plato';

    public $fields = [
        'id' => null,
        'nombre_plato' => null,
        'ingredientes' => null,
        'tipo_plato' => null,
        'precio' => null,
        'path_img' => null
    ];

    public function setId($id)
    {
        $this->fields['id'] = $id;
    }

    public function setNombrePlato($nombrePlato) 
    {
        $this->fields['nombre_plato'] = $nombrePlato;
    }

    public function setIngredientes($ingredientes) 
    {
        $this->fields['ingredientes'] = $ingredientes;
    }

    public function setTipoPlato($tipoPlato)
    {
        $this->fields['tipo_plato'] = $tipoPlato;
    }

    public function setPrecio($precio)
    {
        $this->fields['precio'] = $precio;
    }

    public function setPathImg($pathImg)
    {
        $this->fields['path_img'] = $pathImg;
    }

    public function set(array $values)
    {
        foreach($values as $field => $value)
        {
            if(!isset($values[$field]))
            {
                continue;
            }
            
            $method = 'set'.str_replace('_', '', ucwords($field, '_'));//ucfirst($field);
            $this->$method($value);
        }
        
    }

    public function load($id)
    {
        $params = [ "id" => $id];
        $record = current($this->queryBuilder->select($this->table, $params));
        $this->set($record);
    }    

    public function insert()
    {
        // $this->logger->info("Inserting", [$this->fields]);
        global $log;

        // $log->info("queryBuilder [insertPlato]: ", [$this->queryBuilder]);

        return $this->queryBuilder->insert($this->table, $this->fields);
    }
}