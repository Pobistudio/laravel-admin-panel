<?php

namespace App\Http\Requests\Menus;

use App\Utils\SessionUtils;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
            'name'       => ['required', 'max:100', 'unique:menus,name'],
            'link'       => ['nullable', 'string', 'max:100'],
            'link_alias' => ['nullable', 'string', 'max:100'],
            'icon'       => ['nullable', 'string', 'max:100'],
            'parent'     => ['required'],
            'order'      => ['nullable', 'integer'],
        ];
    }
}
