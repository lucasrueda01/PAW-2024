<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PrimerasTablasMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $tablePlato = $this->table('plato');
        $tablePlato->addColumn('nombre_plato', 'string', ['limit' => 60])
                   ->addColumn('descripcion', 'string', ['null' => true])
                   ->addColumn('tipo_plato', 'string', ['null' => true])
                   ->addColumn('precio', 'integer', ['null' => true])
                   ->addColumn('path_img', 'string', ['null' => true])                   
                   ->addIndex('id', ['unique' => true])
                   ->create();  
    }
}
