<?php

namespace App\Http\Requests;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        //Create rules array to create task with Multiple Notes (pass notes in array format) in a single request
        return [
            'subject' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date_format:d-m-Y',
            'due_date' => 'required|date_format:d-m-Y',
            'status' => ['required', new Enum(TaskStatus::class)],
            'priority' => ['required', new Enum(TaskPriority::class)],
            'notes' => 'required|array',
            'notes.*.subject' => 'required|string|max:255',
            'notes.*.attachment.*' => 'nullable|file',
            'notes.*.note' => 'required|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'subject.required' => 'The subject is required.',
            'description.required' => 'The description is required.',
            'start_date.required' => 'The start date is required.',
            'due_date.required' => 'The due date is required.',
            'status.required' => 'The status is required.',
            'priority.required' => 'The priority is required.',
            'notes.required' => 'The notes is required.',
            'notes.*.note.required' => 'The note is required.',
            'subject.string' => 'The subject must be a string.',
            'description.string' => 'The description must be a string.',
            'status.string' => 'The status must be a string.',
            'priority.string' => 'The priority must be a string.',
            'notes.*.note.string' => 'The note must be a string.',
            'start_date.date_format' => 'The start date must be a date format d-m-y.',
            'due_date.date_format' => 'The due date must be a date format.',
            'subject.max' => 'The subject may not be greater than 255 characters.',
            'description.max' => 'The description may not be greater than 255 characters.',
            'notes.*.note.max' => 'The note may not be greater than 255 characters.',
            'notes.*.attachment.*.file' => 'The attachment must be a file.',
        ];
    }
}
