<?php

namespace App\Services\Interface;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskServiceInterface
{
    public function getTasks(?string $status, ?string $from, ?string $to, int $limit, int $offset): Collection;

    public function createTask(array $validatedData): Task;

    public function getTaskById(int $id): ?Task;

    public function updateTask(Task $task, array $validatedData): bool;

    public function deleteTask(Task $task): bool;
}
