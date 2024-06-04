<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddIdLocalToReservas extends AbstractMigration
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
        $table = $this->table('reservas');
        $table->addColumn('id_local', 'integer', ['signed' => false])
              ->addForeignKey('id_local', 'locales', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
              ->update();
    }
}
