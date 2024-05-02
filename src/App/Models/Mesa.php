<?php 


namespace Paw\App\Models;

use Paw\Core\Model;

use Exception;
use Paw\Core\Exceptions\InvalidValueFormatException;

use Paw\App\Utils\Uploader;
use Paw\App\Utils\Verificador;

class Mesa extends Model
{       
    public $table = 'mesa';

    public $fields = [
        'id' => null,
        'nombre_mesa' => null,
        'capacidad' => null,
        'local' => null
    ];

    public function __construct($datosMesa=[])
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
    }

}