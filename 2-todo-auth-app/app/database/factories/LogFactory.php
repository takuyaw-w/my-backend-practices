<?php

namespace Database\Factories;

use App\Models\ApiToken;
use App\Models\Log;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Log>
 */
class LogFactory extends Factory
{
    protected $model = Log::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'endpoint' => $this->faker->url,
            'method' => $this->faker->randomElement(['GET', 'POST', 'PUT', 'DELETE']),
            'request_payload' => json_encode(['key' => 'value']),
            'response_payload' => json_encode(['key' => 'value']),
            'user_id' => User::factory(),
            'token_id' => ApiToken::factory(),
            'created_pg' => 'factory',
        ];
    }
}
