<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class CombinedSeeder extends AbstractSeed
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
                'username' => 'cliente1',
                'password' => password_hash('password1', PASSWORD_DEFAULT),
                'tipo' => 'cliente',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'cliente2',
                'password' => password_hash('password2', PASSWORD_DEFAULT),
                'tipo' => 'cliente',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'empleado1',
                'password' => password_hash('password3', PASSWORD_DEFAULT),
                'tipo' => 'empleado',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'empleado2',
                'password' => password_hash('password4', PASSWORD_DEFAULT),
                'tipo' => 'empleado',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $users = $this->table('users');
        $users->insert($data)
              ->saveData();
    }
}
