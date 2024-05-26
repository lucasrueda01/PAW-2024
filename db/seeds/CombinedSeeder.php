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
        // Define the data to be inserted
        $data = [
            [
                'username' => 'john_doe',
                'email' => 'john@example.com',
                'password' => password_hash('password1', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'jane_doe',
                'email' => 'jane@example.com',
                'password' => password_hash('password2', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'alice',
                'email' => 'alice@example.com',
                'password' => password_hash('password3', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'bob',
                'email' => 'bob@example.com',
                'password' => password_hash('password4', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert the data into the users table
        $users = $this->table('users');
        $users->insert($data)->saveData();
    }
}
