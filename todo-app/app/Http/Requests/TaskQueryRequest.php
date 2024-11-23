<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskQueryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'nullable|in:pending,in_progress,completed',
            'limit' => 'nullable|integer|min:1',
            'offset' => 'nullable|integer|min:0',
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
        ];
    }

    public function messages()
    {
        return [
            'status.in' => 'The status value must be one of the following: pending, in_progress, completed.',
            'limit.integer' => 'The limit must be a valid integer.',
            'offset.integer' => 'The offset must be a valid integer.',
            'from.date' => 'The from date must be a valid date.',
            'to.date' => 'The to date must be a valid date.',
            'to.after_or_equal' => 'The to date must be after or equal to the from date.',
        ];
    }
}
