<?php

use Phinx\Seed\AbstractSeed;

class AutorSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run():void
    {
        // Insertando datos en la tabla 'autor'
        $data = [
            [
                'nombre' => 'Nombre Autor 1',
                'email' => 'autor1@example.com',
            ],
            [
                'nombre' => 'Nombre Autor 2',
                'email' => 'autor2@example.com',
            ],
            // Agrega más datos de autores aquí si es necesario
        ];

        $autores = $this->table('autor');
        $autores->insert($data)
                ->save();
    }
}
