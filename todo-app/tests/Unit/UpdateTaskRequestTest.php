<?php

namespace Tests\Unit;

use App\Http\Requests\StoreTaskRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class UpdateTaskRequestTest extends TestCase
{
    // 有効なデータでのバリデーションが成功することをテスト
    public function test_store_task_request_with_valid_data()
    {
        $data = [
            'title' => 'Test Task',
            'description' => 'This is a test description',
            'status' => 'pending',
            'priority' => 'medium',
            'due_date' => now()->addDays(5)->toDateString(),
        ];

        $request = new StoreTaskRequest;
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->passes());
    }

    // タイトルがない場合のバリデーションエラーをテスト
    public function test_store_task_request_fails_without_title()
    {
        $data = [
            'description' => 'This is a test description',
            'status' => 'pending',
            'priority' => 'medium',
            'due_date' => now()->addDays(5)->toDateString(),
        ];

        $request = new StoreTaskRequest;
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('title', $validator->errors()->toArray());
    }

    // 無効なステータスでのバリデーションエラーをテスト
    public function test_store_task_request_fails_with_invalid_status()
    {
        $data = [
            'title' => 'Test Task',
            'description' => 'This is a test description',
            'status' => 'invalid_status',
            'priority' => 'medium',
            'due_date' => now()->addDays(5)->toDateString(),
        ];

        $request = new StoreTaskRequest;
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('status', $validator->errors()->toArray());
    }

    // 無効なプライオリティでのバリデーションエラーをテスト
    public function test_store_task_request_fails_with_invalid_priority()
    {
        $data = [
            'title' => 'Test Task',
            'description' => 'This is a test description',
            'status' => 'pending',
            'priority' => 'invalid_priority',
            'due_date' => now()->addDays(5)->toDateString(),
        ];

        $request = new StoreTaskRequest;
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('priority', $validator->errors()->toArray());
    }

    // 無効な日付フォーマットのバリデーションエラーをテスト (due_date)
    public function test_store_task_request_fails_with_invalid_due_date()
    {
        $data = [
            'title' => 'Test Task',
            'description' => 'This is a test description',
            'status' => 'pending',
            'priority' => 'medium',
            'due_date' => 'invalid_date',
        ];

        $request = new StoreTaskRequest;
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('due_date', $validator->errors()->toArray());
    }

    // 過去の日付でのバリデーションエラーをテスト (due_date)
    public function test_store_task_request_fails_with_past_due_date()
    {
        $data = [
            'title' => 'Test Task',
            'description' => 'This is a test description',
            'status' => 'pending',
            'priority' => 'medium',
            'due_date' => now()->subDays(1)->toDateString(),
        ];

        $request = new StoreTaskRequest;
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('due_date', $validator->errors()->toArray());
    }
}
