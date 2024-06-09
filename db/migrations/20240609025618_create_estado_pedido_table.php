<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateEstadoPedidoTable extends AbstractMigration
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
        // Create estado_pedido table
        $table = $this->table('estado_pedido', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'integer', ['signed' => false, 'identity' => true])
              ->addColumn('status_name', 'string', ['limit' => 50])
              ->create();

        // Insert data into estado_pedido table
        $data = [
            ['status_name' => 'Pedido aceptado'],
            ['status_name' => 'En preparación'],
            ['status_name' => 'Finalizado'],
            ['status_name' => 'Despachado'],
            ['status_name' => 'Pasar a retirar']
        ];
        $this->table('estado_pedido')->insert($data)->save();

        // Modify pedidos table
        $table = $this->table('pedidos');
        $table->addColumn('estado_id', 'integer', ['null' => true, 'signed' => false, 'after' => 'monto_total'])
              ->addForeignKey('estado_id', 'estado_pedido', 'id', ['delete'=> 'SET_NULL', 'update'=> 'NO_ACTION'])
              ->removeColumn('estado')
              ->update();
    }
}
