<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogoValidateRequest extends FormRequest
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
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'logo.mimes' => 'Allowed file types are jpg, jpeg, png.',
            'logo.max' => 'Maximum allowed file size is 2MB.',
        ];
    }
}
