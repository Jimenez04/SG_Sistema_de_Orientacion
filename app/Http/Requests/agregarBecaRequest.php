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
            'categoria_Beca' => 'required|numeric|min:0|max:5',

            'asistencia_Socioeconomica' => 'required_if:categoria_Beca,>,0|numeric|min:0|max:1',
            'participacion' => 'required_if:categoria_Beca,>,0|numeric|min:0|max:1',
        ];
    }

    public function messages()
    {
        return [
            //user data
            'categoria_Beca.required' => 'La categoría  es requerida',
            'categoria_Beca.min' => 'La categoría  no es valida, debe tener al menos 0',
            'categoria_Beca.max' => 'La categoría  no es valida, debe tener maximo 5',

            'asistencia_Socioeconomica.required_if' => 'La asistencia socieconomica es requerida',
            'asistencia_Socioeconomica.max' => 'La asistencia socieconomica debe ser 1 0 2',
            'asistencia_Socioeconomica.min' => 'La asistencia socieconomica debe ser 1 0 2',
            
            'participacion.required_if' => 'La participacion es requerida',
            'participacion.max' => 'La participacion debe ser 1 0 2',
            'participacion.min' => 'La participacion debe ser 1 0 2',

        ];
    }
}
