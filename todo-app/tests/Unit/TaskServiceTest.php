<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskServiceTest extends TestCase
{
    use RefreshDatabase;

    protected TaskService $taskService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->taskService = new TaskService;
    }

    public function test_can_get_tasks()
    {
        Task::factory()->count(5)->create(['status' => 'pending']);
        $tasks = $this->taskService->getTasks('pending', null, null, 10, 0);

        $this->assertCount(5, $tasks);
    }

    public function test_can_create_task()
    {
        $data = [
            'title' => 'Test Task',
            'description' => 'This is a test description',
            'status' => 'pending',
            'priority' => 'medium',
            'due_date' => now()->addDays(5)->toDateString(),
        ];

        $task = $this->taskService->createTask($data);

        $this->assertInstanceOf(Task::class, $task);
        $this->assertDatabaseHas('tasks', ['title' => 'Test Task', 'due_date' => $data['due_date']]);
    }

    public function test_can_get_task_by_id()
    {
        $task = Task::factory()->create();

        $foundTask = $this->taskService->getTaskById($task->id);

        $this->assertNotNull($foundTask);
        $this->assertEquals($task->id, $foundTask->id);
    }

    public function test_can_update_task()
    {
        $task = Task::factory()->create(['status' => 'pending']);

        $updatedData = [
            'title' => 'Updated Task',
            'status' => 'completed',
            'due_date' => now()->addDays(10)->toDateString(),
        ];

        $result = $this->taskService->updateTask($task, $updatedData);

        $this->assertTrue($result);
        $task->refresh();
        $this->assertEquals('Updated Task', $task->title);
        $this->assertEquals('completed', $task->status);
        $this->assertEquals($updatedData['due_date'], $task->due_date->toDateString());
    }

    public function test_can_delete_task()
    {
        $task = Task::factory()->create();

        $result = $this->taskService->deleteTask($task);

        $this->assertTrue($result);
        $this->assertModelMissing($task);
    }
}
