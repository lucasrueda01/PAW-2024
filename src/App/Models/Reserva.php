<?php 


namespace Paw\App\Models;

use Paw\Core\Model;

use Exception;
use Paw\Core\Exceptions\InvalidValueFormatException;

use Paw\App\Utils\Uploader;
use Paw\App\Utils\Verificador;
use PDOException;

class Reserva extends Model
{       
    public $table = 'reservas';

    public $fields = [
        'id' => null,
        'id_local' => null,
        'id_mesa' => null,
        'fecha_hora_inicio' => null,
        'fecha_hora_final' => null,
        'ocupada' => null
    ];

    public function __construct($datosReserva=[], $qb=null)
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

        if(is_null($this->queryBuilder) && $qb){
            $this->queryBuilder = $qb;
        }
    }

    // Setter para 'id'
    public function setId($id) {
        $this->fields['id'] = $id;
    }

    // Getter para 'id'
    public function getId() {
        return $this->fields['id'];
    }

    // Setter para 'id_local'
    public function setIdLocal($id_local) {
        $this->fields['id_local'] = $id_local;
    }

    // Getter para 'id_local'
    public function getIdLocal() {
        return $this->fields['id_local'];
    }

    // Setter para 'id_mesa'
    public function setIdMesa($id_mesa) {
        $this->fields['id_mesa'] = $id_mesa;
    }

    // Getter para 'id_mesa'
    public function getIdMesa() {
        return $this->fields['id_mesa'];
    }

    // Setter para 'fecha_hora_inicio'
    public function setFechaHoraInicio($fecha_hora_inicio) {
        $this->fields['fecha_hora_inicio'] = $fecha_hora_inicio;
    }

    // Getter para 'fecha_hora_inicio'
    public function getFechaHoraInicio() {
        return $this->fields['fecha_hora_inicio'];
    }

    // Setter para 'fecha_hora_final'
    public function setFechaHoraFinal($fecha_hora_final) {
        $this->fields['fecha_hora_final'] = $fecha_hora_final;
    }

    // Getter para 'fecha_hora_final'
    public function getFechaHoraFinal() {
        return $this->fields['fecha_hora_final'];
    }

    // Setter para 'ocupada'
    public function setOcupada($ocupada) {
        $this->fields['ocupada'] = $ocupada;
    }

    // Getter para 'ocupada'
    public function getOcupada() {
        return $this->fields['ocupada'];
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

    public function load($idLocal, $idMesa)
    {
        $params = [ "id_local" => $idLocal, "mesa_id" => $idMesa];
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

    public function insert($data)
    {
        try {
            return $this->queryBuilder->insert($this->table, $data);
        } catch (PDOException $e) {
            
            $this->queryBuilder->logger->error("Error al insertar la reserva: " . $e->getMessage());
            return [null, false];
        }
    }

}