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
                'nombre_plato' => 'Big Power',
                'ingredientes' => 'DOBLE MEDALLON DE 100GR. LECHUGA, CHEDDAR, CEBOLLA, PEPINOS Y SALSA POWER',
                'tipo_plato' => 'Hamburguesa',
                'precio' => 8000,
                'path_img' => 'BigPower.jpg',
            ],
            [
                'nombre_plato' => 'Cheeseburger',
                'ingredientes' => 'DOBLE MEDALLON DE 100GR. SMASHEADAS CON CEBOLLA Y CHEDDAR',
                'tipo_plato' => 'Hamburguesa',
                'precio' => 8000,
                'path_img' => 'Cheeseburger.jpg',
            ],
            [
                'nombre_plato' => 'Oklahoma',
                'ingredientes' => 'DOBLE MEDALLON DE 100GR. CON QUESO CHEDDAR',
                'tipo_plato' => 'Hamburguesa',
                'precio' => 8000,
                'path_img' => 'Oklahoma.jpg',
            ],
            [
                'nombre_plato' => 'Roasted Herb Potatoes',
                'ingredientes' => 'Aceite en aerosol1 libra papas (3 papas medanas o 3 tazas de papas en trozos)2 cucharaditas aceite vegetal1/2 cucharadita romero1/2 cucharadita sal',
                'tipo_plato' => 'Otro Plato',
                'precio' => 9000,
                'path_img' => 'RoastedHerbPotatoes.jpg',
            ],
            [
                'nombre_plato' => 'Coca-Cola',
                'ingredientes' => 'Lata de 354ml',
                'tipo_plato' => 'Bebida',
                'precio' => 1100,
                'path_img' => 'Coca.jpg',
            ],
            [
                'nombre_plato' => 'Sprite',
                'ingredientes' => 'Lata de 354ml',
                'tipo_plato' => 'Bebida',
                'precio' => 1100,
                'path_img' => 'Sprite.png',
            ],
            [
                'nombre_plato' => 'Fanta',
                'ingredientes' => 'Lata de 354ml',
                'tipo_plato' => 'Bebida',
                'precio' => 1100,
                'path_img' => 'Fanta.jpg',
            ],
            [
                'nombre_plato' => 'Papas Fritas',
                'ingredientes' => 'Porcion de papas Fritas',
                'tipo_plato' => 'Otro Plato',
                'precio' => 3500,
                'path_img' => 'Papas.webp',
            ],
            [
                'nombre_plato' => 'Papas Fritas con Cheddar',
                'ingredientes' => 'PORCION DE PAPAS FRITAS CON CHEDDAR',
                'tipo_plato' => 'Otro Plato',
                'precio' => 4000,
                'path_img' => 'Papas_Cheddar.jpg',
            ],
            [
                'nombre_plato' => 'Muzarelitas',
                'ingredientes' => 'BASTONES DE MUZZARELLA CON DIP DE SALSA A ELECCION.',
                'tipo_plato' => 'Otro Plato',
                'precio' => 4000,
                'path_img' => 'Muzarelitas.jpg',
            ],
        
        ];

        $table = $this->table('plato');
        $table->insert($data)->save();
    }
}
