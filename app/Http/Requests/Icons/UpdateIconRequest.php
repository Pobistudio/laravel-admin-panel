<?php

namespace App\Http\Requests\Icons;

use App\Utils\SessionUtils;
use Illuminate\Foundation\Http\FormRequest;

class UpdateIconRequest extends FormRequest
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
            'name'    => ['required', 'string', 'max:50'],
            'type'    => ['required', 'string', 'max:50'],
            'section' => ['required', 'string', 'max:50'],
        ];
    }
}
