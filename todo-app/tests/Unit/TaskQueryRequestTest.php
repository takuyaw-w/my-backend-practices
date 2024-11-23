<?php

namespace Tests\Unit;

use App\Http\Requests\TaskQueryRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class TaskQueryRequestTest extends TestCase
{
    protected array $rules;

    protected function setUp(): void
    {
        parent::setUp();
        $this->refreshApplication();

        $request = new TaskQueryRequest;
        $this->rules = $request->rules();
    }

    public function test_task_query_request_with_valid_data()
    {
        $data = [
            'status' => 'pending',
            'from' => '2024-01-01',
            'to' => '2024-12-31',
            'limit' => 10,
            'offset' => 5,
        ];

        $validator = Validator::make($data, $this->rules);
        $this->assertTrue($validator->passes());
    }

    public function test_task_query_request_fails_with_invalid_status()
    {
        $data = [
            'status' => 'invalid_status',
            'from' => '2024-01-01',
            'to' => '2024-12-31',
            'limit' => 10,
            'offset' => 5,
        ];

        $validator = Validator::make($data, $this->rules);
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('status', $validator->errors()->toArray());
    }

    // 無効な日付フォーマットのバリデーションエラーをテスト (from)
    public function test_task_query_request_fails_with_invalid_from_date()
    {
        $data = [
            'status' => 'pending',
            'from' => 'invalid_date', // 無効な日付
            'to' => '2024-12-31',
            'limit' => 10,
            'offset' => 5,
        ];

        $validator = Validator::make($data, $this->rules);
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('from', $validator->errors()->toArray());
    }

    // 無効な日付フォーマットのバリデーションエラーをテスト (to)
    public function test_task_query_request_fails_with_invalid_to_date()
    {
        $data = [
            'status' => 'pending',
            'from' => '2024-01-01',
            'to' => 'invalid_date', // 無効な日付
            'limit' => 10,
            'offset' => 5,
        ];

        $validator = Validator::make($data, $this->rules);
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('to', $validator->errors()->toArray());
    }

    // limitが無効な場合のバリデーションエラーをテスト
    public function test_task_query_request_fails_with_invalid_limit()
    {
        $data = [
            'status' => 'pending',
            'from' => '2024-01-01',
            'to' => '2024-12-31',
            'limit' => -1, // 無効なlimit
            'offset' => 5,
        ];

        $validator = Validator::make($data, $this->rules);
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('limit', $validator->errors()->toArray());
    }

    // offsetが無効な場合のバリデーションエラーをテスト
    public function test_task_query_request_fails_with_invalid_offset()
    {
        $data = [
            'status' => 'pending',
            'from' => '2024-01-01',
            'to' => '2024-12-31',
            'limit' => 10,
            'offset' => -5, // 無効なoffset
        ];

        $validator = Validator::make($data, $this->rules);
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('offset', $validator->errors()->toArray());
    }
}
