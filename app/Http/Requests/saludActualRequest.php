<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class saludActualRequest extends FormRequest
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
                'saludActual.afectacionDesempeno' => 'required|numeric|min:0|max:1',
                'saludActual.enfermedad' => 'required_if:saludActual.afectacionDesempeno,==,1|string|min:6|max:254',
                'saludActual.tratamiento' => 'required_if:saludActual.afectacionDesempeno,==,1|string|min:6',
        ];
    }

    public function messages()
    {
        return [
            'saludActual.afectacionDesempeno.required' =>  'El campo "¿Padece alguna enfermedad que le afecta su desempeño?" es obligatorio.',
            'saludActual.afectacionDesempeno.min' =>  'El campo "¿Padece alguna enfermedad que le afecta su desempeño?" debe ser falso o verdadero.',
            'saludActual.afectacionDesempeno.max' =>  'El campo "¿Padece alguna enfermedad que le afecta su desempeño?" debe ser falso o verdadero.',
            'saludActual.afectacionDesempeno.numeric' =>  'El campo "¿Padece alguna enfermedad que le afecta su desempeño?" debe ser un entero.',

            'saludActual.enfermedad.required_if' =>  'El campo "¿Cuál? (Enfermedad)" es obligatorio.',
            'saludActual.enfermedad.min' =>  'El campo "¿Cuál? (Enfermedad)" debe contener al menos 6 caracteres.',
            'saludActual.enfermedad.max' =>  'El campo "¿Cuál? (Enfermedad)" debe contener menos  de 254 caracteres.',
            'saludActual.enfermedad.string' =>  'El campo "¿Cuál? (Enfermedad)" debe ser una cadena de caracteres.',

            'saludActual.tratamiento.required_if' =>  'El campo "Tratamiento (Enfermedad)" es obligatorio.',
            'saludActual.tratamiento.min' =>  'El campo "Tratamiento (Enfermedad)" debe contener al menos 6 caracteres.',
            'saludActual.tratamiento.string' =>  'El campo "Tratamiento (Enfermedad)" debe ser una cadena de caracteres.',

        ];
    }
}
