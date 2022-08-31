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
            'trabajo_Actual' => 'required|string|max:40',
            'actividad_Que_Desempena' => 'required|string',
            'lugar_De_Trabajo' => 'required|string|max:40',
            'jornada_Trabajo' => 'required|string|max:40',
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

            'trabajo_Actual.required' => 'El trabajo actual es requerido',
            'trabajo_Actual.max' => 'El trabajo actual no debe ser mayor a 40 caracteres',
            'trabajo_Actual.string' => 'El trabajo actual debe ser una cadena de caracteres',
            
            'actividad_Que_Desempena.required' => 'La actividad es requerida',
            'actividad_Que_Desempena.string' => 'La actividad debe ser una cadena de caracteres',

            'lugar_De_Trabajo.required' => 'El lugar de trabajo es requerido',
            'lugar_De_Trabajo.string' => 'El lugar de trabajo debe ser una cadena de caracteres',
            'lugar_De_Trabajo.max' => 'El lugar de trabajo no debe ser mayor a 40 caracteres',

            'jornada_Trabajo.required' => 'La jornada es requerida',
            'jornada_Trabajo.string' => 'La jornada debe ser una cadena de caracteres',
            'jornada_Trabajo.max' => 'La jornada debe ser mayor a 40 caracteres',

            'horario_Laboral.required' => 'El horario es requerida',
            'horario_Laboral.string' => 'El horario debe ser una cadena de caracteres',
        ];
    }
}
