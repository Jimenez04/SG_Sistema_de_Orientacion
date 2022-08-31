<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateEnfermedad__request extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cedula' => 'required|min:9|max:20',
            'id' => 'required|numeric',
            'tipo_Enfermedad' => 'string|max:255',
            'descripcion' => 'string',
            'tratamiento' => 'string',
            'rutina_Tratamiento' => 'string',
        ];
    }

    public function messages()
    {
        return [
            //user data
            'cedula.required' => 'La cédula es requerida',
            'cedula.min' => 'La cedula no es valida, debe tener al menos 9 caracteres',
            'cedula.max' => 'La cedula no es valida, debe tener maximo 20 caracteres',

            'id.numeric' => 'El id debe ser un número entero',
            'id.required' => 'El id es requerido',


            'tipo_Enfermedad.required' => 'El tipo de enfermedad es requerido',
            'tipo_Enfermedad.max' => 'El tipo de enfermedad no debe ser maor a 255 caracteres',
            'tipo_Enfermedad.string' => 'El tipo de enfermedad debe ser una cadena de caracteres',
            
            'descripcion.required' => 'La descripción es requerida',
            'descripcion.string' => 'La descripción debe ser una cadena de caracteres',

            'tratamiento.required' => 'El tratamiento es requerida',
            'tratamiento.string' => 'El tratamiento debe ser una cadena de caracteres',

            'rutina_Tratamiento.required' => 'La rutina de tratamiento es requerida',
            'rutina_Tratamiento.string' => 'La rutina de tratamiento debe ser una cadena de caracteres',
        ];
    }
}
