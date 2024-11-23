<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'priority' => 'required|in:loq,medium,high',
            'due_date' => 'nullable|date|after_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be one of: pending, in_progress, completed.',
            'priority.required' => 'The priority field is required.',
            'priority.in' => 'The priority must be one of: low, medium, high.',
            'due_date.after_or_equal' => 'The due date must be today or a future date.',
        ];
    }
}
