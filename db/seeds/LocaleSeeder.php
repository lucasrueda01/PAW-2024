<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class LocaleSeeder extends AbstractSeed
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
        $localesData = [
            [
                'nombre' => 'Local A',
                'hora_apertura' => '09:00',
                'hora_cierre' => '21:00',
            ],
            [
                'nombre' => 'Local B',
                'hora_apertura' => '09:00',
                'hora_cierre' => '21:00',
            ]
        ];

        // Insert locales data
        $locales = $this->table('locales');
        $locales->insert($localesData)->saveData();

        // Fetch inserted locales IDs
        $locales = $this->fetchAll('SELECT id, nombre FROM locales');
        $localesMap = [];
        foreach ($locales as $local) {
            $localesMap[$local['nombre']] = $local['id'];
        }

        // Mesas data
        $mesasData = [];
        $mesasMap = [];
        $localesAndMesas = [
            'Local A' => ["mesa-162", "mesa-161", "mesa-144", "mesa-143", "mesa-142", "mesa-141", "mesa-126", "mesa-125", "mesa-124", "mesa-123", "mesa-122", "mesa-121", "mesa-342", "mesa-341", "mesa-322", "mesa-321", "mesa-262", "mesa-261", "mesa-241", "mesa-223", "mesa-222", "mesa-221"],
            'Local B' => ["mesa-162", "mesa-161", "mesa-144", "mesa-143", "mesa-142", "mesa-141", "mesa-126", "mesa-125", "mesa-124", "mesa-123", "mesa-122", "mesa-121", "mesa-342", "mesa-341", "mesa-322", "mesa-321", "mesa-262", "mesa-261", "mesa-241", "mesa-223", "mesa-222", "mesa-221"]
        ];

        foreach ($localesAndMesas as $localName => $mesas) {
            foreach ($mesas as $mesaName) {
                $mesasData[] = [
                    'local_id' => $localesMap[$localName],
                    'nombre' => $mesaName
                ];
                $mesasMap[$localName][$mesaName] = count($mesasData);
            }
        }

        // Insert mesas data
        $mesas = $this->table('mesas');
        $mesas->insert($mesasData)->saveData();

        // Users data
        $users = $this->fetchAll('SELECT id FROM users');
        $userIds = array_column($users, 'id');

        // Reservas data
        $reservasData = [];
        foreach ($localesAndMesas as $localName => $mesas) {
            foreach ($mesas as $mesaName) {
                $userId = $userIds[array_rand($userIds)]; // Seleccionar un ID de usuario aleatorio
                $reservasData[] = [
                    'mesa_id' => $mesasMap[$localName][$mesaName],
                    'id_user' => $userId,
                    'id_local' => $localesMap[$localName],
                    'fecha' => date('Y-m-d'),
                    'hora_inicio' => '09:00', // Hora de inicio de la reserva
                    'hora_fin' => '10:30' // Hora de fin de la reserva
                ];
            }
        }

        // Insert reservas data
        $reservas = $this->table('reservas');
        $reservas->insert($reservasData)->saveData();
    }
}
