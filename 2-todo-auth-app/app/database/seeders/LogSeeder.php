<?php

namespace Database\Seeders;

use App\Models\ApiToken;
use App\Models\Log;
use App\Models\User;
use Illuminate\Database\Seeder;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            Log::factory(5)->create([
                'user_id' => $user->id,
                'token_id' => ApiToken::where('user_id', $user->id)->inRandomOrder()->first()->id ?? null,
            ]);
        });
    }
}
