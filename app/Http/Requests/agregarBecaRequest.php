<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class agregarBecaRequest extends FormRequest
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
            'categoria_Beca' => 'required|numeric|min:0|    max:5',
            'asistencia_Socioeconomica' => 'string|max:40',
            'participacion' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            //user data
            'categoria_Beca.required' => 'La categoría  es requerida',
            'categoria_Beca.min' => 'La categoría  no es valida, debe tener al menos 0',
            'categoria_Beca.max' => 'La categoría  no es valida, debe tener maximo 5',

            'asistencia_Socioeconomica.max' => 'La asistencia socieconomica sobrepasa 40 caracteres',
            'asistencia_Socioeconomica.string' => 'La asistencia socieconomica debe ser una cadena de caracteres',
            
            'participacion.required' => 'La participacion es requerida',
            'participacion.string' => 'La participacion debe ser una cadena de caracteres',

        ];
    }
}