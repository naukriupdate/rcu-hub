<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResourceUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'file' => ['required', 'file'],
            'uploader_type' => ['required', 'in:student,teacher'],
            'uploader_name' => ['required', 'string', 'max:255'],
            'department_id' => ['required', 'exists:departments,id'],
            'program_id' => ['required', 'exists:programs,id'],
            'semester_id' => ['required', 'exists:semesters,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'resource_type_id' => ['required', 'exists:resource_types,id'],
            'academic_year' => ['nullable', 'string', 'max:20'],
            'description' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
