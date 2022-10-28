<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class observationRequest extends FormRequest
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
                'nombre' => 'required|min:6|max:54|string',

                'descripcion' => 'required|min:6|string',

            ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'nombre.min' => 'El nombre no es valido, debe tener al menos 6 caracteres',
            'nombre.max' => 'El nombre no es valido, debe tener maximo 54 caracteres',
            'nombre.string' => 'El nombre debe ser una cadena de caracteres',

            'descripcion.required' => 'La descripción es requerida',
            'descripcion.min' => 'La descripcón no es valida, debe tener al menos 6 caracteres',
            'descripcion.string' => 'La descripción debe ser una cadena de caracteres',

        ];
    }
}
