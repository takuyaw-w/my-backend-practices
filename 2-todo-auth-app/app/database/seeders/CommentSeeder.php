<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Todo;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Todo::all()->each(function ($todo) {
            Comment::factory(3)->create([
                'todo_id' => $todo->id,
                'user_id' => $todo->created_by,
            ]);
        });
    }
}
