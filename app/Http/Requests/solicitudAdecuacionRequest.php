<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class solicitudAdecuacionRequest extends FormRequest
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
                'solicitud.razon_Solicitud' => 'required|min:10|max:254|string',

                'solicitud.carrera_Empadronada' => 'required|string|min:4|max:255',
                'solicitud.ano_ingreso_carrera' => 'required|date_format:Y-m-d',
                'solicitud.nivel_carrera' => 'required|numeric|min:0|max:100',

                'solicitud.nombre_segunda_carrera' => 'string|min:4|max:250',

                'solicitud.realizo_Traslado_Carrera' => 'required|numeric|min:0|max:1',
                'solicitud.carrera_empadronado_anterior' => 'required_if:solicitud.realizo_Traslado_Carrera,==,1 |string|max:255',
            ];
    }

    public function messages()
    {
        return [
            //user data
            'solicitud.razon_Solicitud.required' => 'Ocupa una razón para realizar esta solicitud.',
            'solicitud.razon_Solicitud.min' => 'La razón debe tener al menos diez caracteres.',
            'solicitud.razon_Solicitud.max' => 'La razón debe tener al menos veinte caracteres.',
            'solicitud.razon_Solicitud.string' => 'La razón debe ser una cadena de caracteres.',

            'solicitud.carrera_Empadronada.required' => 'La carrera empadronada es requerida.',
            'solicitud.carrera_Empadronada.string' => 'La carrera empadronada debe ser una cadena de caracteres.',
            'solicitud.carrera_Empadronada.max' => 'La carrera empadronada no puede superar los 250 caracteres.',
            'solicitud.carrera_Empadronada.max' => 'La carrera empadronada no puede ser menor a 5 caracteres.',
            
            'solicitud.nombre_segunda_carrera.string' => 'El nombre de la segunda carrera debe ser una cadena de caracteres.',
            'solicitud.nombre_segunda_carrera.max' => 'El nombre de la segunda carrera no puede superar los 250 caracteres.',
            'solicitud.nombre_segunda_carrera.max' => 'El nombre de la segunda carrera no puede ser menor a 5 caracteres.',

            'solicitud.nivel_carrera.required' => 'El campo nivel de carrera es requerido.',
            'solicitud.nivel_carrera.numeric' => 'El campo nivel de carrera debe ser un número entre 0 y 100.',
            'solicitud.nivel_carrera.min' => 'El campo nivel de carrera no debe ser menor a 0.',
            'solicitud.nivel_carrera.max' => 'El campo nivel de carrera no puede ser mayor a 100.',
            
            'solicitud.realizo_Traslado_Carrera.required' => 'Debe indicar si realizó el traslado de carrera.',
            'solicitud.realizo_Traslado_Carrera.numeric' => 'El campo "traslado de carrera" debe ser un número entre 0 y 1.',
            'solicitud.realizo_Traslado_Carrera.min' => 'El campo "traslado de carrera" no debe ser menor a 0.',
            'solicitud.realizo_Traslado_Carrera.max' => 'El campo "traslado de carrera" no puede ser mayor a 1.',

            'solicitud.carrera_empadronado_anterior.required_if' =>  'El campo carrera empadronada anterior es obligatorio.',
            'solicitud.carrera_empadronado_anterior.string' => 'El campo carrera empadronada anterior debe ser una cadena de caracteres.',
            'solicitud.carrera_empadronado_anterior.max' => 'El campo carrera empadronada anterior no puede superar los 250 caracteres.',
            'solicitud.carrera_empadronado_anterior.max' => 'El campo carrera empadronada anterior no puede ser menor a 5 caracteres.',

            'solicitud.ano_ingreso_carrera.required' => 'La fecha de ingreso a carrera es requerida',
            'solicitud.ano_ingreso_carrera.date_format' => 'La fecha de ingreso carrera no tiene un formato valido',
        ];
    }
}
