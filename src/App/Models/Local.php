<?php 


namespace Paw\App\Models;

use Paw\Core\Model;

use Exception;
use Paw\Core\Exceptions\InvalidValueFormatException;

use Paw\App\Utils\Uploader;
use Paw\App\Utils\Verificador;

class Local extends Model
{       
    public $table = 'locales';

    public $fields = [
        'id' => null,
        'nombre' => null,
        'hora_apertura' => null,
        'hora_cierre' => null
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

    public function setNombre($nombre)
    {
        $this->fields['nombre_local'] = $nombre;
    }

    public function getNombre()
    {
        return $this->fields['nombre_local'];
    }

    public function setHoraApertura($horaApertura)
    {
        $this->fields['hora_apertura'] = $horaApertura;
    }

    public function getHoraApertura()
    {
        return $this->fields['hora_apertura'];
    }

    public function setHoraCierre($horaCierre)
    {
        $this->fields['hora_cierre'] = $horaCierre;
    }

    public function getHoraCierre()
    {
        return $this->fields['hora_cierre'];
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
        global $log;

        $params = ["nombre" => ($nombreLocal == null) ? $this->getNombreLocal() : $nombreLocal];

        $log->info("params: ", [$params, $this->table]);
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