<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class update_grantRequest extends FormRequest
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
            'carnet' => 'required|min:4|max:20',
            'categoria_Beca' => 'numeric|min:0|max:5',
            'asistencia_Socioeconomica' => 'required_if:categoria_Beca,>,0|numeric|min:0|max:1',
            'participacion' => 'required_if:categoria_Beca,>,0|numeric|min:0|max:1',
        ];
    }

    public function messages()
    {
        return [
            //user data
            'carnet.required' => 'El carnet es requerido',
            'carnet.min' => 'El carnet no es valido, debe tener al menos 4 caracteres',
            'carnet.max' => 'El carnet no es valido, debe tener maximo 20 caracteres',

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
