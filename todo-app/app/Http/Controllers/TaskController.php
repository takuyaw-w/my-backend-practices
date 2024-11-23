<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\TaskQueryRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    //
    public function index(TaskQueryRequest $request): JsonResponse
    {
        $status = $request->query('status');
        $from = $request->query('from');
        $to = $request->query('to');
        $limit = $request->query('limit', 10);
        $offset = $request->query('offset', 0);

        $tasks = $this->taskService->getTasks(
            $status, $from, $to, $limit, $offset
        );

        return response()->json($tasks, 200);
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $task = $this->taskService->createTask($validated);

        return response()->json($task, 201);
    }

    public function show(int $id): JsonResponse
    {
        $task = $this->taskService->getTaskById($id);

        if (! $task) {
            return response()->json(['message' => 'Task not found.', 404]);
        }

        return response()->json($task, 200);
    }

    public function update(UpdateTaskRequest $request, int $id): JsonResponse
    {
        $task = $this->taskService->getTaskById($id);

        if (! $task) {
            return response()->json(['message' => 'Task not found.', 404]);
        }

        $validated = $request->validated();

        if (! $this->taskService->updateTask($task, $validated)) {
            return response()->json(['message' => 'Failed to update task.'], 500);
        }
        $task->refresh();

        return response()->json($task, 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $task = $this->taskService->getTaskById($id);

        if (! $task) {
            return response()->json(['message' => 'Task not found.', 404]);
        }

        $deleted = $this->taskService->deleteTask($task);
        if (! $deleted) {
            return response()->json(['message' => 'Failed to delete task.'], 500);
        }

        return response()->json(['message' => 'Task deleted successfully', 200]);
    }
}
