<?php 

namespace Paw\App\Models;

use Paw\Core\Model;

use Exception;

class Plato extends Model
{       
    public $table = 'pedido';

    public $fields = [
        'id' => null,
        'nombre_mesa' => null,
        'capacidad' => null,
        'local' => null
    ];    

}