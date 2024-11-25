<?php

namespace App\Services\Interface;

use App\Models\Task;
use Illuminate\Support\Collection;

interface TaskServiceInterface
{
    public function getTasks(?string $status, ?string $from, ?string $to, int $limit = 10, int $offset = 0): Collection;

    public function createTask(array $validatedData): Task;

    public function getTaskById(int $id): ?Task;

    public function updateTask(Task $task, array $validatedData): bool;

    public function deleteTask(Task $task): bool;
}
