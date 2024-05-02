<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class CombinedSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        // Datos para la tabla 'local'
        $localData = [
            ['nombre' => 'local-avellaneda', 'ubicacion' => 'california 456']
        ];

        // Insertar datos en la tabla 'local'
        $this->table('local')->insert($localData)->save();

        // Obtener el ID del local insertado
        $localId = $this->fetchRow('SELECT id FROM local')['id'];

        // Datos para la tabla 'mesa'
        $mesaData = [
            ['nombre_mesa' => 'mesa-162', 'capacidad' => 6, 'local' => $localId],
            ['nombre_mesa' => 'mesa-161', 'capacidad' => 6, 'local' => $localId],
            ['nombre_mesa' => 'mesa-144', 'capacidad' => 4, 'local' => $localId],
            ['nombre_mesa' => 'mesa-143', 'capacidad' => 4, 'local' => $localId],
            ['nombre_mesa' => 'mesa-142', 'capacidad' => 4, 'local' => $localId],
            ['nombre_mesa' => 'mesa-141', 'capacidad' => 4, 'local' => $localId],
            ['nombre_mesa' => 'mesa-126', 'capacidad' => 2, 'local' => $localId],
            ['nombre_mesa' => 'mesa-125', 'capacidad' => 2, 'local' => $localId],
            ['nombre_mesa' => 'mesa-124', 'capacidad' => 2, 'local' => $localId],
            ['nombre_mesa' => 'mesa-123', 'capacidad' => 2, 'local' => $localId],
            ['nombre_mesa' => 'mesa-122', 'capacidad' => 2, 'local' => $localId],
            ['nombre_mesa' => 'mesa-121', 'capacidad' => 2, 'local' => $localId],
            ['nombre_mesa' => 'mesa-342', 'capacidad' => 4, 'local' => $localId],
            ['nombre_mesa' => 'mesa-341', 'capacidad' => 4, 'local' => $localId],
            ['nombre_mesa' => 'mesa-322', 'capacidad' => 2, 'local' => $localId],
            ['nombre_mesa' => 'mesa-321', 'capacidad' => 2, 'local' => $localId],
            ['nombre_mesa' => 'mesa-262', 'capacidad' => 6, 'local' => $localId],
            ['nombre_mesa' => 'mesa-261', 'capacidad' => 6, 'local' => $localId],
            ['nombre_mesa' => 'mesa-241', 'capacidad' => 4, 'local' => $localId],
            ['nombre_mesa' => 'mesa-223', 'capacidad' => 2, 'local' => $localId],
            ['nombre_mesa' => 'mesa-222', 'capacidad' => 2, 'local' => $localId],
            ['nombre_mesa' => 'mesa-221', 'capacidad' => 2, 'local' => $localId]
        ];

        // Insertar datos en la tabla 'mesa'
        $this->table('mesa')->insert($mesaData)->save();

        // Obtener la fecha y hora actual
        date_default_timezone_set('America/Argentina/Buenos_Aires');

        $currentDateTime = date('Y-m-d H:i:s');

        // Calcular la fecha y hora final sumando 1 hora y 30 minutos a la fecha y hora actual
        $finalDateTime = date('Y-m-d H:i:s', strtotime('+1 hour 30 minutes', strtotime($currentDateTime)));

        $reservaData = [
            ['id_local' => 1, 'id_mesa' => 1, 'fecha_hora_inicio' => $currentDateTime, 'fecha_hora_final' => $finalDateTime, 'ocupada' => true],
            ['id_local' => 1, 'id_mesa' => 2, 'fecha_hora_inicio' => $currentDateTime, 'fecha_hora_final' => $finalDateTime, 'ocupada' => false],
            ['id_local' => 1, 'id_mesa' => 3, 'fecha_hora_inicio' => $currentDateTime, 'fecha_hora_final' => $finalDateTime, 'ocupada' => true]
        ];

        $this->table('reserva')->insert($reservaData)->save();        
    }
}
