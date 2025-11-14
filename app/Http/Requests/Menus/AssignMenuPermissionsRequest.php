<?php

namespace App\Http\Requests\Menus;

use App\Utils\SessionUtils;
use Illuminate\Foundation\Http\FormRequest;

class AssignMenuPermissionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return SessionUtils::isExist();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role'     => ['required', 'exists:roles,id'],
            'mappings' => ['required', 'array'],
        ];
    }
}
