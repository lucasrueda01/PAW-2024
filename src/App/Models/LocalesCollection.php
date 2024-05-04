<?php 


namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\App\Models\Plato;



class LocalesCollection extends Model
{
    public $table = 'local';

    public function getAll()
    {

        // crear tantos autor como filas de la tabla autores
        $locales = $this->queryBuilder->select($this->table);        

        $localCollection = [];
        foreach ($locales as $local)
        {
            $newLocal = new Plato;
            $newLocal->set($local);
            $localCollection[] = $newLocal;
        }

        return $localCollection;
    }

    public function get($id)
    {
        $local = new Local;
        $local->setQueryBuilder($this->queryBuilder);
        $result = $local->load($id);
        return [$result, $local];
    }

   public function obtenerMesas($nombreLocal, $fechaInicio, $horaInicio) 
   {
        require_once 'reservas-json.php';

        $local = array_filter($localData, function($local) use ($nombreLocal) {
            return $local['nombre_local'] == $nombreLocal;
        });

        if (empty($local)) {
            echo "Local no encontrado.";
            return;
        }

        $localId = reset($local)['id']; // Obtener el ID del primer resultado

        // Calcular fecha y hora de inicio como un solo string
        $fechaHoraInicio = date('Y-m-d H:i:s', strtotime("$fechaInicio $horaInicio"));
    
        // Filtrar las reservas para el local específico
        $reservasLocal = array_filter($reservaData, function($reserva) use ($localId) {
            return $reserva['id_local'] == $localId;
        });
    
        // Inicializar arrays para mesas ocupadas y desocupadas
        $mesasOcupadas = [];
        $mesasDesocupadas = [];
    
        // Buscar mesas ocupadas para el local en el momento dado
        foreach ($reservasLocal as $reserva) {
            if ($reserva['fecha_hora_inicio'] <= $fechaHoraInicio && $reserva['fecha_hora_final'] > $fechaHoraInicio) {
                $mesasOcupadas[] = $this->obtenerNombreMesa($mesaData, $reserva['id_mesa']);
            }
        }
    
        // Obtener mesas desocupadas
        foreach ($mesaData as $mesa) {
            if (!in_array($mesa['id'], $mesasOcupadas)) {
                $mesasDesocupadas[] = $this->obtenerNombreMesa($mesaData, $mesa['id']);
            }
        }
        
        return [$mesasOcupadas, $mesasDesocupadas];

   }


   public function obtenerNombreMesa($mesaData, $mesaId){
        $mesasFiltradas = array_filter($mesaData, function($mesa) use ($mesaId) {
            return $mesa['id'] === $mesaId;
        });

        // Obtener el nombre de la mesa si se encontró
        return !empty($mesasFiltradas) ? reset($mesasFiltradas)['nombre_mesa'] : null;
    
   }

}
