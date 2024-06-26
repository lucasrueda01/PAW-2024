<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddTipoToUsers extends AbstractMigration
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
        // Agregar columna 'tipo' a la tabla 'users'
        $table = $this->table('users');
        $table->addColumn('tipo', 'enum', ['values' => ['cliente', 'empleado'], 'default' => 'cliente'])
              ->update();
    }
}
