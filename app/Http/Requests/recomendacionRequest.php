<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class recomendacionRequest extends FormRequest
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
                'nombre_Especialista' => 'required|min:6|max:54|string',

                'descripcion_Recomendacion' => 'required|min:6|string',

            ];
    }

    public function messages()
    {
        return [
            'nombre_Especialista.required' => 'El nombre del especialista  es requerido',
            'nombre_Especialista.min' => 'El nombre del especialista no es valido, debe tener al menos 6 caracteres',
            'nombre_Especialista.max' => 'El nombre del especialista no es valido, debe tener maximo 54 caracteres',
            'nombre_Especialista.string' => 'El nombre del especialista debe ser una cadena de caracteres',

            'descripcion_Recomendacion.required' => 'La descripción es requerida',
            'descripcion_Recomendacion.min' => 'La descripcón no es valida, debe tener al menos 6 caracteres',
            'descripcion_Recomendacion.string' => 'La descripción debe ser una cadena de caracteres',

        ];
    }
}
