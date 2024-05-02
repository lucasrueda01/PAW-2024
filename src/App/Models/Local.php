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

    public function __construct($datosLocal=[])
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
    }
    public function loadByName($name)
    {
        $params = [ "nombre_local" => $name];
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