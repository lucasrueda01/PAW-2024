<?php 


namespace Paw\App\Models;

use Paw\Core\Model;

use Exception;
use Paw\Core\Exceptions\InvalidValueFormatException;

use Paw\App\Utils\Uploader;
use Paw\App\Utils\Verificador;

class Local extends Model
{       
    public $table = 'local';

    public $fields = [
        'id' => null,
        'nombre_local' => null,
        'ubicacion' => null
    ];

    public function __construct($datosLocal=[], $qb=null)
    {   
        if (!is_null($datosLocal) && is_array($datosLocal)) {

            try {
                $verificador = new Verificador();
                if ($verificador->array_has_empty_values(array_values($datosLocal))) {
                    throw new Exception("Faltan datos para crear el objeto Local ");
                }
                
                foreach ($datosLocal as $key => $value) {
                    if(!key_exists($key, $this->fields)){
                        throw new Exception("No existe le key: $key");
                    }
                    $this->fields[$key] = $value;
                }                
            } catch (Exception $e) {
                echo "Error al crear el objeto Local: " . $e->getMessage();    
            }
        }
        if(is_null($this->queryBuilder) && $qb){
            $this->queryBuilder = $qb;
        }
    }

    public function setId($id)
    {
        $this->fields['id'] = $id;
    }

    public function getId()
    {
        return $this->fields['id'];
    }

    public function setNombreLocal($nombre)
    {
        $this->fields['nombre_local'] = $nombre;
    }

    public function getNombreLocal()
    {
        return $this->fields['nombre_local'];
    }

    public function setUbicacion($ubicacion)
    {
        $this->fields['ubicacion'] = $ubicacion;
    }

    public function getUbicacion()
    {
        return $this->fields['ubicacion'];
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

    public function loadByName($nombreLocal=null)
    {
        $params = ["nombre_local" => ($nombreLocal == null) ? $this->getNombreLocal() : $nombreLocal];

        try{
            $record = current($this->queryBuilder->select($this->table, $params));
            if($record){
                $this->set($record);
            }else{
                return [
                    'error' => true,
                    'description' => 'No Existe el Name buscado'
                ];
            }
        }catch(Exception $e){
            throw new Exception("Error no existe Name {$e}");
        }
    }    
}