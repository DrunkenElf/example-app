<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCategoryRequest extends FormRequest
{
    public function rules(): array
    {

        return [
            'name' => ['required', 'string'],
            'description' => ['sometimes', 'nullable', 'string'],
            'active' => ['required', Rule::in(['0','1','true','false'])]
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'Название категории. Англ., кириллица',
            'description' => 'Описание категории. Англ., кириллица',
            'active' => 'Вкл, выкл',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
