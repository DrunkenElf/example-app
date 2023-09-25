<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function rules(): array
    {

        return [
            'id' => ['required', 'integer'],
            'name' => ['sometimes', 'string'],
            'description' => ['sometimes', 'string'],
            'active' => ['sometimes', 'boolean']
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'id' => 'id категории',
            'name' => 'Название категории. Англ., кириллица',
            'description' => 'Описание категории. Англ., кириллица',
            'active' => 'Вкл, выкл',
        ];
    }
}
