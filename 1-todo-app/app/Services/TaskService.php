<?php

namespace App\Services;

use App\Models\Task;
use App\Services\Interface\TaskServiceInterface;
use Illuminate\Support\Collection;

class TaskService implements TaskServiceInterface
{
    public function getTasks(
        ?string $status,
        ?string $from,
        ?string $to,
        int $limit = 10,
        int $offset = 0): Collection
    {
        return Task::query()
            ->status($status)
            ->fromDate($from)
            ->toDate($to)
            ->limitOffset($limit, $offset)
            ->get();
    }

    public function createTask(array $validatedData): Task
    {
        return Task::create($validatedData);
    }

    public function getTaskById(int $id): ?Task
    {
        return Task::find($id);
    }

    public function updateTask(Task $task, array $validatedData): bool
    {
        return $task->update($validatedData);
    }

    public function deleteTask(Task $task): bool
    {
        return $task->delete();
    }
}
