<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|min:3|max:255|unique:permissions",
            "description" => "nullable|min:3|max:255"
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é requerido',
            'name.min' => 'O campo nome precisa de no minimo 3 caracteres',
            'name.max' => 'O campo nome precisa de no máximo de 255 caracteres',
            'name.unique' => 'Este nome já está em uso, escolha outro',
            'description.min' => 'O campo descrição precisa de no minimo 3 caracteres',
            'description.max' => 'O campo descrição precisa de no máximo de 255 caracteres',
        ];
    }
}
