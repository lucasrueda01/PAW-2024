<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddUserIdToReservas extends AbstractMigration
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
        // Agregar la columna id_user a la tabla reservas
        $this->table('reservas')
            ->addColumn('id_user', 'integer', ['signed' => false, 'null' => true])
            ->addForeignKey('id_user', 'users', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
            ->update();
    }
}
