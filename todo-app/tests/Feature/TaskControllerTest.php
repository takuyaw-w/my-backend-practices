<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_can_get_all_tasks(): void
    {
        Task::factory()->count(3)->create();
        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_create_task(): void
    {
        $taskData = [
            'title' => 'Test',
            'description' => 'Test Description',
            'status' => 'pending',
            'priority' => 'medium',
        ];

        $response = $this->postJson('/api/tasks', $taskData);

        $response->assertStatus(201)
            ->assertJsonFragment(['title' => 'Test']);
        $this->assertDatabaseHas('tasks', ['title' => 'Test']);
    }

    public function test_can_get_single_task()
    {
        $task = Task::factory()->create();

        $response = $this->getJson('/api/tasks/' . $task->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => $task->title]);
    }

    public function test_can_update_task()
    {
        $task = Task::factory()->create();

        $updateData = [
            'title' => 'update task',
            'description' => 'update description',
            'status' => 'in_progress',
            'priority' => 'high',
        ];

        $response = $this->putJson('/api/tasks/' . $task->id, $updateData);
        $response->assertStatus(200)
            ->assertJsonFragment(['title' => 'update task']);
        $this->assertDatabaseHas('tasks', ['title' => 'update task']);
    }

    public function test_can_delete_task()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson('/api/tasks/' . $task->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Task deleted successfully']);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
