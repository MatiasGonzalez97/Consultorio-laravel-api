<?php

namespace App\Http\Requests\Treatment;

use Illuminate\Foundation\Http\FormRequest;

class CreateTreatmentRequest extends FormRequest
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
            'dentist_id.required' => 'El dentist_id es requerido',
            'patient_id.required' => 'El patient_id es requerido',
            'plates.required' => 'El campo plates es requerido',
            'plates.numeric' => 'El campo plates debe ser de tipo int',
            'dentist_id.numeric' => 'El campo dentist_id debe ser de tipo int',
            'patient_id.numeric' => 'El campo patient_id debe ser de tipo int',
            'external_id.unique' => 'El campo external_id debe ser unico' 
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
            'external_id'=>'numeric|unique:treatments,external_id',
            'dentist_id' => 'required|numeric',
            'patient_id' => 'required|numeric',
            'plates' => 'required|numeric'
        ];
    }
}
