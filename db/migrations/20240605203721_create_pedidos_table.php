<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePedidosTable extends AbstractMigration
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
        $table = $this->table('pedidos');
        $table->addColumn('fecha_hora', 'datetime')
              ->addColumn('tipo', 'enum', ['values' => ['empleado', 'cliente']])
              ->addColumn('id_usuario', 'integer', ['signed' => false])
              ->addColumn('metodo_pago', 'enum', ['values' => ['mercado_pago', 'efectivo']])
              ->addColumn('direccion', 'text')
              ->addColumn('observaciones', 'text', ['null' => true])
              ->addColumn('monto_total', 'decimal', ['precision' => 10, 'scale' => 2])
              ->addColumn('estado', 'enum', ['values' => ['sin-confirmar', 'confirmado', 'en-camino']])
              ->addTimestamps()
              ->addForeignKey('id_usuario', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
              ->create();

              $table = $this->table('detalle_pedidos');
              $table->addColumn('id_pedido', 'integer', ['signed' => false])
                    ->addColumn('nombre_articulo', 'text')
                    ->addColumn('precio', 'decimal', ['precision' => 10, 'scale' => 2])
                    ->addColumn('cantidad', 'integer')
                    ->addColumn('subtotal', 'decimal', ['precision' => 10, 'scale' => 2])
                    ->addForeignKey('id_pedido', 'pedidos', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                    ->create();              
    }   
}
