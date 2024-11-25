<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_tasks()
    {
        // タスクを作成
        Task::factory()->count(3)->create([
            'status' => 'pending',
            'priority' => 'medium',
            'due_date' => now()->addDays(5)->toDateString(),
        ]);

        // 全タスクを取得するテスト
        $response = $this->getJson('/api/tasks');
        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(3);

        // クエリパラメーター: ステータスとリミット・オフセットの組み合わせの確認
        $filteredResponse = $this->getJson('/api/tasks?status=pending&limit=2&offset=1');
        $filteredResponse->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(2);

        // クエリパラメーターによるフィルタリングの確認
        $filteredResponse = $this->getJson('/api/tasks?status=completed');
        $filteredResponse->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(0);
    }

    public function test_can_create_task()
    {
        $taskData = [
            'title' => 'Test Task',
            'description' => 'This is a test task',
            'status' => 'pending',
            'priority' => 'medium',
            'due_date' => now()->addDays(5)->toDateString(),
        ];

        $response = $this->postJson('/api/tasks', $taskData);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonFragment(['title' => 'Test Task']);
    }

    public function test_can_show_task()
    {
        $task = Task::factory()->create(['id' => 1]);

        $response = $this->getJson('/api/tasks/1');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment(['title' => $task->title]);
    }

    public function test_update_task()
    {
        $task = Task::factory()->create([
            'id' => 1,
            'title' => 'Original Task',
        ]);

        $taskData = [
            'title' => 'Updated Task',
            'description' => 'Updated description',
            'status' => 'in_progress',
            'priority' => 'high',
            'due_date' => now()->addDays(10)->toDateString(),
        ];

        $response = $this->putJson("/api/tasks/{$task->id}", $taskData);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment(['title' => 'Updated Task']);
    }

    public function test_delete_task()
    {
        $task = Task::factory()->create(['id' => 1]);

        $response = $this->deleteJson('/api/tasks/1');

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment(['message' => 'Task deleted successfully']);
    }
}
