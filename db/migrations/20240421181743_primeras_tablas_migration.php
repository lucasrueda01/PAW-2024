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
                   ->addColumn('ingredientes', 'string', ['null' => true])
                   ->addColumn('tipo_plato', 'string', ['null' => true])
                   ->addColumn('precio', 'integer', ['null' => true])
                   ->addColumn('path_img', 'string', ['null' => true])                   
                   ->addIndex('id', ['unique' => true])
                   ->create();  

        // Crear tabla "local"
        $local = $this->table('local');
        $local->addColumn('nombre_local', 'string')
            ->addColumn('ubicacion', 'string')
            ->addIndex('id', ['unique' => true])
            ->create();

        // Crear tabla "mesa"
        $mesa = $this->table('mesa');
        $mesa->addColumn('nombre_mesa', 'string')
            ->addColumn('capacidad', 'integer', ['limit' => 2])
            ->addColumn('local', 'integer', ['signed' => false])  
            ->addForeignKey('local', 'local', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])  
            ->create();

        $table = $this->table('reserva');
        $table->addColumn('id_local', 'integer', ['signed' => false])
                ->addColumn('id_mesa', 'integer', ['signed' => false])
                ->addColumn('fecha_hora_inicio', 'datetime')
                ->addColumn('fecha_hora_final', 'datetime')
                ->addColumn('ocupada', 'boolean', ['default' => false])
                ->addForeignKey('id_local', 'local', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('id_mesa', 'mesa', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->create();
    }
}
