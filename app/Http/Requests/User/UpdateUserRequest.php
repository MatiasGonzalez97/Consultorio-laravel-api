<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

    public function messages()
    {
        return [
            'gender.in' => 'No ha seleccionado una opción correcta, los valores posibles son m, f, o',
            'email.email' => 'El email no tiene formato válido',
            'email.unique' => 'El email ya existe',
        ];
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'gender'=>'in:m, f, o',
            'email' => 'email|unique:users,email',
        ];
    }
}
