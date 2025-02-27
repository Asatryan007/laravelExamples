<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCreateValidateRequest extends FormRequest
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
            'title' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s]+$/',
            'description' => 'required|string|max:255',
            'startedAt' => 'nullable|date',
            'completedAt' => 'nullable|date',
            'deadline' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The Title field is required.',
            'title.max' => 'The Title may not be greater than 255 characters.',
            'title.regex' => 'The Title format is invalid.',
            'description.required' => 'The Description field is required.',
            'description.max' => 'The Description may not be greater than 255 characters.',
        ];
    }
}
