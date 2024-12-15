<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            Todo::factory(5)->create([
                'created_by' => $user->id,
                'assigned_user_id' => $user->id,
            ]);
        });
    }
}
