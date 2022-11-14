<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateJob_request extends FormRequest
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
            'actividad_Que_Desempena' => 'string',
            'lugar_De_Trabajo' => 'string|max:40',
            'horario_Laboral' => 'string',
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

            'actividad_Que_Desempena.max' => 'La actividad no debe ser mayor a 80 caracteres',
            'actividad_Que_Desempena.string' => 'La actividad debe ser una cadena de caracteres',

            'lugar_De_Trabajo.string' => 'El lugar de trabajo debe ser una cadena de caracteres',
            'lugar_De_Trabajo.max' => 'El lugar de trabajo no debe ser mayor a 40 caracteres',

            'horario_Laboral.string' => 'El horario debe ser una cadena de caracteres',
        ];
    }
}
