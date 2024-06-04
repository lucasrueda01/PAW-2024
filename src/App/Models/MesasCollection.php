<?php 


namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\App\Models\Mesa;

class MesasCollection extends Model
{
    public $table = 'mesa';

    public $idLocal = null;

    public function __construct($idLocal=null)
    {
        $this->idLocal = $idLocal;
    }

    public function getIdLocal()
    {
        return $this->idLocal;
    }

    public function getAll()
    {
        try {
            // Realizar la consulta
            $mesas = $this->queryBuilder->select($this->table, ['local' => $this->getIdLocal()]);
            
            // Mostrar la consulta realizada
            $this->logger->info("Consulta realizada: " . $this->queryBuilder->getLastQuery());
    
            return $mesas;
            
        } catch (\Exception $e) {
            
            $this->logger->info("Error al obtener todas las mesas: " . $e->getMessage());


            return null; // Otra acción adecuada para manejar el error
        }
    }

    public function get($id)
    {
        $local = new Local;
        $local->setQueryBuilder($this->queryBuilder);
        $result = $local->loadByName($id);
        return [$result, $local];
    }

    public function getReservas()
    {
        // Obtener todos los locales
        $localesData = $this->queryBuilder->select('locales');
        
        // Inicializar la estructura de locales
        $locales = [];
        
        foreach ($localesData as $local) {
            $localId = $local['id'];
            $localName = $local['nombre'];
            $locales[$localName] = [
                'horaApertura' => $local['hora_apertura'],
                'horaCierre' => $local['hora_cierre'],
                'mesa' => []
            ];

            // Obtener todas las mesas para el local actual
            $mesasData = $this->queryBuilder->select('mesas', ['local_id' => $localId]);
            foreach ($mesasData as $mesa) {
                $mesaName = $mesa['nombre'];
                $locales[$localName]['mesa'][] = $mesaName;

                // Obtener todas las reservas para la mesa actual
                $reservasData = $this->queryBuilder->select('reservas', ['mesa_id' => $mesa['id']]);
                foreach ($reservasData as $reserva) {
                    $fecha = $reserva['fecha'];
                    if (!isset($locales[$localName][$fecha])) {
                        $locales[$localName][$fecha] = [];
                    }

                    $locales[$localName][$fecha][$mesaName][] = [
                        'horaInicio' => $reserva['hora_inicio'],
                        'horaFin' => $reserva['hora_fin']
                    ];
                }
            }
        }

        return $locales;
    }


}
