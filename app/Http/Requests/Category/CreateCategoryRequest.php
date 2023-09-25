<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /*public function messages()
    {
        return parent::messages(); // TODO: Change the autogenerated stub
    }*/

    public function rules(): array
    {

        return [
            'name' => ['required', 'string'],
            'description' => ['sometimes', 'string'],
            'active' => ['required', 'boolean']
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