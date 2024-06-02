<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLocalesMesasReservasTables extends AbstractMigration
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
        // Tabla locales
        $locales = $this->table('locales');
        $locales->addColumn('nombre', 'string', ['limit' => 255])
                ->addColumn('hora_apertura', 'time')
                ->addColumn('hora_cierre', 'time')
                ->create();

        // Tabla mesas
        $mesas = $this->table('mesas');
        $mesas->addColumn('local_id', 'integer', ['signed' => false])
              ->addColumn('nombre', 'string', ['limit' => 255])
              ->addForeignKey('local_id', 'locales', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
              ->create();

        // Tabla reservas
        $reservas = $this->table('reservas');
        $reservas->addColumn('mesa_id', 'integer', ['signed' => false])
                 ->addColumn('fecha', 'date')
                 ->addColumn('hora_inicio', 'time')
                 ->addColumn('hora_fin', 'time')
                 ->addForeignKey('mesa_id', 'mesas', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
                 ->create();
    }
}
