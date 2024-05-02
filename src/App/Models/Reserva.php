<?php 


namespace Paw\App\Models;

use Paw\Core\Model;

use Exception;
use Paw\Core\Exceptions\InvalidValueFormatException;

use Paw\App\Utils\Uploader;
use Paw\App\Utils\Verificador;

class Reserva extends Model
{       
    public $table = 'reserva';

    public $fields = [
        'id' => null,
        'id_local' => null,
        'id_mesa' => null,
        'fecha_hora_inicio' => null,
        'fecha_hora_final' => null,
        'ocupada' => null
    ];

    public function __construct($datosReserva=[])
    {   
        if (!is_null($datosReserva) && is_array($datosReserva)) {

            try {
                $verificador = new Verificador();
                if ($verificador->array_has_empty_values(array_values($datosReserva))) {
                    throw new Exception("Faltan datos para crear el objeto Reserva ");
                }
                
                foreach ($datosReserva as $key => $value) {
                    if(!key_exists($key, $this->fields)){
                        throw new Exception("No existe le key: $key");
                    }
                    $this->fields[$key] = $value;
                }                
            } catch (Exception $e) {
                echo "Error al crear el objeto Reserva: " . $e->getMessage();    
            }
        }
    }

}