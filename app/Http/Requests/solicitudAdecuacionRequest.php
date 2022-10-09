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
                'solicitud.carrera_Empadronada' => 'required|string|',
                'solicitud.carreras_simultaneas' => 'required|numeric|min:0|max:1',
                'solicitud.realizo_Traslado_Carrera' => 'required|numeric|min:0|max:1',
                'solicitud.descripcion' => 'required|string',
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

            'solicitud.carreras_simultaneas.required' => 'El campo de carreras simultáneas es requerido.',
            'solicitud.carreras_simultaneas.numeric' => 'El campo de carreras simultáneas debe ser un número entre 0 y 1.',
            'solicitud.carreras_simultaneas.min' => 'El campo de carreras simultáneas no debe ser menor a 0.',
            'solicitud.carreras_simultaneas.max' => 'El campo de carreras simultáneas no puede ser mayor a 1.',
            
            'solicitud.realizo_Traslado_Carrera.required' => 'Debe indicar si realizó el traslado de carrera.',
            'solicitud.realizo_Traslado_Carrera.numeric' => 'El campo "traslado de carrera" debe ser un número entre 0 y 1.',
            'solicitud.realizo_Traslado_Carrera.min' => 'El campo "traslado de carrera" no debe ser menor a 0.',
            'solicitud.realizo_Traslado_Carrera.max' => 'El campo "traslado de carrera" no puede ser mayor a 1.',
            
            'solicitud.descripcion.required' => 'La descripción es requerida.',
            'solicitud.descripcion.string' => 'La descripción debe ser una cadena de caracteres.',
        ];
    }
}
