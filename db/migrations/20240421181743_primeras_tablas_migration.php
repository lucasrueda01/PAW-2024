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

        // Create the users table
        $table = $this->table('users');
        
        // Add columns
        $table->addColumn('username', 'string', ['limit' => 50])
              ->addColumn('email', 'string', ['limit' => 100])
              ->addColumn('password', 'string', ['limit' => 255])
              ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('updated_at', 'timestamp', [
                  'null' => true,
                  'default' => 'CURRENT_TIMESTAMP',
                  'update' => 'CURRENT_TIMESTAMP'
              ])
              ->addIndex(['email'], ['unique' => true])
              ->create();                
    }
}
