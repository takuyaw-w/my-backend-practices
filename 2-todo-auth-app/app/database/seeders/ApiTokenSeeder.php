<?php

namespace Database\Seeders;

use App\Models\ApiToken;
use App\Models\User;
use Illuminate\Database\Seeder;

class ApiTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            ApiToken::factory(2)->create(['user_id' => $user->id]);
        });
    }
}
