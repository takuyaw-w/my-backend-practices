<?php

namespace Database\Factories;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    protected $model = Todo::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']),
            'assigned_user_id' => User::factory(),
            'created_by' => User::factory(),
            'created_pg' => 'factory',
            'updated_pg' => 'factory',
        ];
    }
}
