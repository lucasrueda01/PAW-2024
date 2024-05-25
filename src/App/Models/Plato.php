<?php 


namespace Paw\App\Models;

use Paw\Core\Model;

use Exception;
use Paw\Core\Exceptions\InvalidValueFormatException;

use Paw\App\Utils\Uploader;
use Paw\App\Utils\Verificador;

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

    public static $fields_requires = [
        'nombre_plato',
        'ingredientes',
        'tipo_plato',
        'precio', 
        'path_img'      
    ];

    public function __construct($datosPlato=[])
    {   
        if (!is_null($datosPlato) && is_array($datosPlato)) {
            try {
                $verificador = new Verificador();
                if ($verificador->array_has_empty_values(array_values($datosPlato))) {
                    throw new Exception("Faltan datos para crear el objeto Plato ");
                }
                // Asigna los datos al plato
                foreach ($datosPlato as $key => $value) {
                    if(!key_exists($key, $this->fields)){
                        throw new Exception("No existe le key: $key");
                    }
                    $this->fields[$key] = $value;
                }
    
            } catch (Exception $e) {
                echo "Error al crear el objeto Plato: " . $e->getMessage();
            }
        } else {
            echo "Error: Los datos del plato no son válidos.";
        }

    }


    public static function getFieldsRequires()
    {
        return self::$fields_requires;
    }

    public function getAllFields()
    {
        return $this->fields;
    }

    public function setId($id)
    {
        $this->fields['id'] = $id;
    }

    public function getId()
    {
        return $this->fields['id'];
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

    public function getTipoPlato() //GETTER
    {
        return $this->fields['tipo_plato'];
    }

    public function setPrecio($precio) //SETTER
    {
        $this->fields['precio'] = $precio;
    }

    public function getPrecio() //SETTER
    {
        return $this->fields['precio'];
    }

    public function setPathImg($pathImg) //SETTER
    {
        $this->fields['path_img'] = $pathImg;
    }

    public function getPathImg() //GETTER
    {
        return $this->fields['path_img'];
    }

    public function getTypeImg()
    {
        return pathinfo($this->getPathImg(), PATHINFO_EXTENSION);
    }

    public function getImagenPlatoBase64()
    {
        try{
            if (!file_exists(Uploader::UPLOADDIRECTORY.$this->fields['path_img'])) {
                throw new Exception("La imagen no existe en la ruta especificada:". Uploader::UPLOADDIRECTORY.$this->fields['path_img']);
            }            
            $imgPlatoBase64 = base64_encode(file_get_contents(Uploader::UPLOADDIRECTORY.$this->fields['path_img']));
            return $imgPlatoBase64;
        } catch (Exception $e) {
            // Manejo de errores: imprime el mensaje de error
            echo 'Error al obtener la imagen como base64: ' . $e->getMessage();
            return null;
        }
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
        try{
            $record = current($this->queryBuilder->select($this->table, $params));
            
            if($record){
                $this->set($record);
            }else{
                return [
                    'error' => true,
                    'description' => 'No Existe el Id buscado'
                ];
            }
        }catch(Exception $e){
            throw new Exception("Error no existe Id {$e}");
        }
    }    


}