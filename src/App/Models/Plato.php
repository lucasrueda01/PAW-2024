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


    public function getAllFields()
    {
        return $this->fields;
    }

    public function setId($id)
    {
        $this->fields['id'] = $id;
    }

    public function setNombrePlato($nombrePlato) 
    {
        $this->fields['nombre_plato'] = $nombrePlato;
    }

    public function getNombrePlato() // GETTER
    {
        return $this->fields['nombre_plato'];
    }

    public function setIngredientes($ingredientes) //SETTER
    {
        $this->fields['ingredientes'] = $ingredientes;
    }

    public function getIngredientes() //GETTER
    {
        return $this->fields['ingredientes'];
    }

    public function setTipoPlato($tipoPlato) //SETTER
    {
        $this->fields['tipo_plato'] = $tipoPlato;
    }

    public function setPrecio($precio) //SETTER
    {
        $this->fields['precio'] = $precio;
    }

    public function setPathImg($pathImg) //SETTER
    {
        $this->fields['path_img'] = $pathImg;
    }

    public function getPathImg() //GETTER
    {
        return $this->fields['path_img'];
    }

    public function set(array $values)
    {
        foreach($values as $field => $value)
        {
            if(!isset($values[$field]))
            {
                continue;
            }
            
            $method = 'set'.str_replace('_', '', ucwords($field, '_'));
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