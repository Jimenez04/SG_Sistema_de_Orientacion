<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addJob__request extends FormRequest
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
            'actividad_Que_Desempena' => 'required|string|max:80',
            'lugar_De_Trabajo' => 'required|string|max:40',
            'horario_Laboral' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            //user data
            'cedula.required' => 'La cédula es requerida',
            'cedula.min' => 'La cedula no es valida, debe tener al menos 9 caracteres',
            'cedula.max' => 'La cedula no es valida, debe tener maximo 20 caracteres',

            'actividad_Que_Desempena.required' => 'La actividad es requerida',
            'actividad_Que_Desempena.string' => 'La actividad debe ser una cadena de caracteres',
            'actividad_Que_Desempena.max' => 'La actividad a desempeñar no debe ser mayor a 80 caracteres',

            'lugar_De_Trabajo.required' => 'El lugar de trabajo es requerido',
            'lugar_De_Trabajo.string' => 'El lugar de trabajo debe ser una cadena de caracteres',
            'lugar_De_Trabajo.max' => 'El lugar de trabajo no debe ser mayor a 40 caracteres',

            'horario_Laboral.required' => 'El horario es requerida',
            'horario_Laboral.string' => 'El horario debe ser una cadena de caracteres',
        ];
    }
}
