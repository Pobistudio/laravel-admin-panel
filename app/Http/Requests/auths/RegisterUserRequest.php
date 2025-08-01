<?php

namespace App\Http\Requests\auths;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name'   => ['required', 'max:100'],
            'email'  => ['required', 'email', 'max:100', 'unique:users,email'],
            'role'   => ['required'],
            'status' => ['nullable']
        ];
    }
}
