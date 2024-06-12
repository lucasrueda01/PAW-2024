<?php 


namespace Paw\App\Models;

use Paw\Core\Model;
use Paw\App\Models\Plato;

class PlatosCollection extends Model
{
    
    public $table = 'plato';

    public function getAll()
    {
        // crear tantos autor como filas de la tabla autores
        $platos = $this->queryBuilder->select($this->table);

        $platosCollection = [];
        foreach ($platos as $plato)
        {
            $newPlato = new Plato;
            $newPlato->set($plato);
            $platosCollection[] = $newPlato;
        }

        return $platosCollection;
    }

    public function exportToCsv($platos)
    {
        global $log;

        try {
            // Nombre del archivo CSV
            $filename = 'platos_' . date('Ymd') . '.csv';

            // Verificar si se ha enviado alguna salida antes de las cabeceras
            if (headers_sent()) {
                throw new Exception('Las cabeceras ya fueron enviadas.');
            }

            // Cabecera para forzar la descarga del archivo CSV
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="' . $filename . '"');

            // Abrir el archivo de salida en modo escritura
            $output = fopen('php://output', 'w');
            if ($output === false) {
                throw new Exception('No se pudo abrir el flujo de salida para escribir.');
            }


            // Establecer el delimitador a coma y la codificación a UTF-8 BOM para Excel
            fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF)); // Añadir BOM UTF-8 para Excel

            // Escribir los encabezados de la tabla
            fputcsv($output, ['nombre_plato', 'ingredientes', 'tipo_plato', 'precio', 'path_img']);

            // Escribir los datos de los platos
            foreach ($platos as $plato) {
                fputcsv($output, [
                    $plato->getNombrePlato(),
                    $plato->getIngredientes(),
                    $plato->getTipoPlato(),
                    $plato->getPrecio(),
                    $plato->getPathImg()
                ]);
            }

            // Cerrar el archivo de salida
            fclose($output);
            exit; // Asegurarse de que no haya salida adicional

        } catch (Exception $e) {
            // Manejo de excepciones: registrar el error y mostrar un mensaje amigable
            $log->error("error ",[error_log("Error al exportar a CSV: " . $e->getMessage())]);
            header('Content-Type: application/json');
            $log->error("error CSV: ", [json_encode(['error' => 'Hubo un problema al generar el archivo CSV. Inténtalo de nuevo más tarde.'])]);
        }
    }

    public function get($id)
    {
        $plato = new Plato;
        $plato->setQueryBuilder($this->queryBuilder);
        $result = $plato->load($id);
        return [$result, $plato];
    }

    public function insert($newPlato)
    {
        global $log;

        $log->info("queryBuilder [insertPlato]: ", [$newPlato]);

        list($idPlato, $resultado) = $this->queryBuilder->insert($this->table, $newPlato->getAllFields());

        $newPlato->setId($idPlato);
        
        $log->info("resultado insert: ", [$resultado, $idPlato]);

        return [$resultado, $idPlato];
    }    
}
