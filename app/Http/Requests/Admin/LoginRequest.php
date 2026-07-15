<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'email is required.',
            'email.email' => 'Valid email is required.',
            'email.max' => 'Email must not exceed 255 characters.',
            'password.required' => 'Password is required.',
        ];
    }
}
