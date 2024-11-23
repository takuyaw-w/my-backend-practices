<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::all()->each(function ($task) {
            Comment::factory()->count(100)->create([
                'task_id' => $task->id,
            ]);
        });
    }
}
