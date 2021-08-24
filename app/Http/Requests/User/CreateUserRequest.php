<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser un string',
            'surname.string' => 'El surname debe ser un string',
            'surname.required' => 'El campo surname es requerido',
            'gender.required' => 'El genero es requerido',
            'gender.in' => 'No ha seleccionado una opción correcta, los valores posibles son m, f, o',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email no tiene formato válido',
            'email.unique' => 'El email ya existe',
            'password.required' => 'La contraseña es requerida',
            'password.string' => 'La contraseña debe ser un string',
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
            'name'=>'string|required',
            'surname'=>'string|required',
            'gender'=>'required|in:m, f, o',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string'
        ];
    }
}
