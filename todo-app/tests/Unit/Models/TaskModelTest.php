<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_set_and_get_fillable_attributes()
    {
        $task = Task::create([
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'status' => 'pending',
            'priority' => 'medium',
            'due_date' => now()->addDays(5),
        ]);

        $this->assertEquals('Test Task', $task->title);
        $this->assertEquals('This is a test task.', $task->description);
        $this->assertEquals('pending', $task->status);
        $this->assertEquals('medium', $task->priority);
        $this->assertEquals(now()->addDays(5)->toDateString(), $task->due_date->toDateString());
    }

    /** @test */
    public function it_applies_status_scope_correctly()
    {
        Task::factory()->create(['status' => 'pending']);
        Task::factory()->create(['status' => 'completed']);

        $tasks = Task::status('pending')->get();

        $this->assertCount(1, $tasks);
        $this->assertEquals('pending', $tasks->first()->status);
    }

    /** @test */
    public function it_applies_date_scopes_correctly()
    {
        $today = now()->startOfDay();
        $yesterday = now()->subDay()->startOfDay();

        Task::factory()->create(['created_at' => $today]);
        Task::factory()->create(['created_at' => $yesterday]);

        $tasks = Task::fromDate($yesterday->toDateString())
            ->toDate($today->toDateString())
            ->get();

        $this->assertCount(2, $tasks);
    }

    /** @test */
    public function it_applies_limit_offset_scope_correctly()
    {
        Task::factory()->count(5)->create();

        $tasks = Task::limitOffset(2, 1)->get();

        $this->assertCount(2, $tasks);
    }

    /** @test */
    public function it_has_many_comments()
    {
        $task = Task::factory()->create();
        Comment::factory()->create(['task_id' => $task->id]);
        Comment::factory()->create(['task_id' => $task->id]);

        $this->assertCount(2, $task->comments);
    }

    /** @test */
    public function it_handles_nullable_due_date()
    {
        $task = Task::create([
            'title' => 'Task Without Due Date',
            'description' => 'No due date provided.',
            'status' => 'pending',
            'priority' => 'low',
            'due_date' => null,
        ]);

        $this->assertNull($task->due_date);
    }
}
