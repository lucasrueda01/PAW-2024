<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class PrimeraSemillaCargaDePlato extends AbstractSeed
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
        $data = [
            [
                'nombre_plato' => 'Pizza Margarita',
                'descripcion' => 'Pizza de masa fina con tomate, mozzarella y albahaca',
                'tipo_plato' => 'Pizza',
                'precio' => 120,
                'path_img' => 'img/pizza_margarita.jpg',
            ],
            [
                'nombre_plato' => 'Milanesa Napolitana',
                'descripcion' => 'Milanesa de ternera cubierta con salsa de tomate, jamón y queso',
                'tipo_plato' => 'Plato Principal',
                'precio' => 150,
                'path_img' => 'img/milanesa_napolitana.jpg',
            ],
            [
                'nombre_plato' => 'Ensalada César',
                'descripcion' => 'Ensalada de lechuga, pollo, crutones y aderezo César',
                'tipo_plato' => 'Ensalada',
                'precio' => 90,
                'path_img' => 'img/ensalada_cesar.jpg',
            ],
            // Agrega más datos según sea necesario
        ];

        $table = $this->table('plato');
        $table->insert($data)->save();
    }
}
