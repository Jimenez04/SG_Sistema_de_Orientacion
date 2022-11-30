<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class itemBitacoraRequest extends FormRequest
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
            'descripcion' => 'required|min:5|string',
            'acciones_realizadas' => 'required|min:5|string',
            'observaciones' => 'required|string|min:5',
        ];
    }

    public function messages()
    {
        return [
            'descripcion.required' => 'La descriptión es requerida',
            'descripcion.min' => 'La descriptión no es valida, debe tener al menos 5 caracteres',
            'descripcion.string' => 'La descriptión no es valida, debe ser una cadena de caracteres',

            'acciones_realizadas.required' => 'El campo "acciones requeridas" es requerida',
            'acciones_realizadas.min' => 'El campo "acciones requeridas" no es valida, debe tener al menos 5 caracteres',
            'acciones_realizadas.string' => 'El campo "acciones requeridas" no es valida, debe ser una cadena de caracteres',

            'observaciones.required' => 'Las observaciones son requeridas',
            'observaciones.min' => 'Las observaciones no son validas, debe tener al menos 5 caracteres',
            'observaciones.string' => 'Las observaciones no son valida, debe ser una cadena de caracteres',

        ];
    }

}
