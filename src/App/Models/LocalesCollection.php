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

   public function obtenerMesas() 
   {
        // Leer el contenido del archivo mesa.json
        $json = file_get_contents(__DIR__ . '/mesas.json');

        if ($json === false) {
            echo "Error al leer el archivo: " . error_get_last()['message'];
            $this->logger->info("Error al leer: ",[error_get_last()['message']]);
        }
        if ($json === false) {
            // Manejar el error si no se puede leer el archivo
            return [[], []];
        }

        // Decodificar el JSON en un array asociativo
        $datos = json_decode($json, true);      

        return $datos;
   }


   public function obtenerNombreMesa($mesaData, $mesaId){
        $mesasFiltradas = array_filter($mesaData, function($mesa) use ($mesaId) {
            return $mesa['id'] === $mesaId;
        });

        // Obtener el nombre de la mesa si se encontró
        return !empty($mesasFiltradas) ? reset($mesasFiltradas)['nombre_mesa'] : null;
    
   }

}
