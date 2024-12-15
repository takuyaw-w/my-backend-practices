<?php

namespace Database\Factories;

use App\Models\ApiToken;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ApiToken>
 */
class ApiTokenFactory extends Factory
{
    protected $model = ApiToken::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'token' => \Str::random(80),
            'expires_at' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'created_pg' => 'factory',
            'updated_pg' => 'factory'

        ];
    }
}
