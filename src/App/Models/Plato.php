<?php 


namespace Paw\App\Models;

use Paw\Core\Model;

use Exception;
use Paw\Core\Exceptions\InvalidValueFormatException;
use Paw\Core\Traits\Loggable;

class Plato extends Model
{       
    use Loggable;
    public $table = 'plato';

    public $fields = [
        'id' => null,
        'nombrePlato' => null,
        'descripcion' => null,
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

    public function setDescripcion($descripcion) 
    {
        $this->fields['descripcion'] = $descripcion;
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
}