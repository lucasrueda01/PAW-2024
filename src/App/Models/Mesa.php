<?php 


namespace Paw\App\Models;

use Paw\Core\Model;

use Exception;
use Paw\Core\Exceptions\InvalidValueFormatException;

use Paw\App\Utils\Uploader;
use Paw\App\Utils\Verificador;
use PDOException;

class Mesa extends Model
{       
    public $table = 'mesas';

    public $fields = [
        'id' => null,
        'local_id' => null,
        'nombre' => null
    ];

    public function __construct($datosMesa=[], $qb=null)
    {   
        if (!is_null($datosMesa) && is_array($datosMesa)) {

            try {
                $verificador = new Verificador();
                if ($verificador->array_has_empty_values(array_values($datosMesa))) {
                    throw new Exception("Faltan datos para crear el objeto Mesa ");
                }
                
                foreach ($datosMesa as $key => $value) {
                    if(!key_exists($key, $this->fields)){
                        throw new Exception("No existe le key: $key");
                    }
                    $this->fields[$key] = $value;
                }                
            } catch (Exception $e) {
                echo "Error al crear el objeto Mesa: " . $e->getMessage();    
            }
        }

        if(is_null($this->queryBuilder) && $qb){
            $this->queryBuilder = $qb;
        }
    }

    // Getters y Setters
    public function setId($id)
    {
        $this->fields['id'] = $id;
    }

    public function getId()
    {
        return $this->fields['id'];
    }

    public function setLocalId($localId)
    {
        $this->fields['local_id'] = $localId;
    }

    public function getLocalId()
    {
        return $this->fields['local_id'];
    }

    public function setNombre($nombre)
    {
        $this->fields['nombre'] = $nombre;
    }

    public function getNombre()
    {
        return $this->fields['nombre'];
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

    public function loadByName($nombreMesa=null)
    {
        $params = ["nombre" => ($nombreMesa == null) ? $this->getNombreMesa() : $nombreMesa];

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

    public function getIdByNameAndLocal($mesa_nombre, $local_id)
    {
        global $log;

        try {
            $params = ['nombre' => $mesa_nombre, 'local_id' => $local_id];
            $result = $this->queryBuilder->select($this->table, $params);

            return $result ? $result[0]['id'] : null;
        } catch (PDOException $e) {

            $log->error("Error al obtener el ID de la mesa: " . $e->getMessage());

            return null;
        }
    }

}