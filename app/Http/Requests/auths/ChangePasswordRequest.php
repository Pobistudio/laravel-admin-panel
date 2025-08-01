<?php

namespace App\Http\Requests\auths;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends FormRequest
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
            'email'            => ['required', 'email', 'max:100'],
            'new_password'     => ['required', Password::min(6)->letters()->numbers()->symbols()],
            'confirm_password' => ['required'],
        ];
    }
}
