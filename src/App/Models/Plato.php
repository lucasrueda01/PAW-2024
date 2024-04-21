<?php 


namespace Paw\App\Models;

use Paw\Core\Model;

use Exception;
use Paw\Core\Exceptions\InvalidValueFormatException;

class Plato extends Model
{       
    
    public $table = 'plato';

    public $fields = [
        'nombre_plato' => null,
        'descripcion' => null,
        'tipo_plato' => null,
        'precio' => null,
        'path_img' => null
    ];
}