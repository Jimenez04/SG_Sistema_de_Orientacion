<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addManySickness extends FormRequest
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
            'enfermedad.*.id' => 'integer|exists:enfermedads,id',
            'enfermedad.*.tipo_Enfermedad' => 'required|string|max:255',
            'enfermedad.*.descripcion' => 'required|string',
            'enfermedad.*.tratamiento' => 'required|string',
            'enfermedad.*.rutina_Tratamiento' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            //user data
            'enfermedad.*.id.integer' => 'El id debe ser un entero.',
            'enfermedad.*.id.exists' => 'La enfermedad no existe en el sistema.',

            'enfermedad.*.tipo_Enfermedad.required' => 'El tipo de enfermedad es requerido',
            'enfermedad.*.tipo_Enfermedad.max' => 'El tipo de enfermedad no debe ser maor a 255 caracteres',
            'enfermedad.*.tipo_Enfermedad.string' => 'El tipo de enfermedad debe ser una cadena de caracteres',
            
            'enfermedad.*.descripcion.required' => 'La descripción es requerida',
            'enfermedad.*.descripcion.string' => 'La descripción debe ser una cadena de caracteres',

            'enfermedad.*.tratamiento.required' => 'El tratamiento es requerida',
            'enfermedad.*.tratamiento.string' => 'El tratamiento debe ser una cadena de caracteres',

            'enfermedad.*.rutina_Tratamiento.required' => 'La rutina de tratamiento es requerida',
            'enfermedad.*.rutina_Tratamiento.string' => 'La rutina de tratamiento debe ser una cadena de caracteres',
        ];
    }
}
