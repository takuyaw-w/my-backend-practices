<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Users
        $this->call(UsersSeeder::class);

        // Seed API Tokens
        $this->call(ApiTokenSeeder::class);

        // Seed Todos
        $this->call(TodoSeeder::class);

        // Seed Comments
        $this->call(CommentSeeder::class);

        // Seed Logs
        $this->call(LogSeeder::class);
    }
}
