<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateStatus_Request extends FormRequest
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
                'nuevo_Estado' => 'required|numeric|min:1|max:4',

                'descripcion_Rechazado' => 'required_if:nuevo_Estado,==,4|min:6|string',

            ];
    }

    public function messages()
    {
        return [
            'nuevo_Estado.required' => 'El nuevo estado  es requerido',
            'nuevo_Estado.min' => 'El nuevo estado debe ser mayor a 0 y menor a 5',
            'nuevo_Estado.max' => 'El nuevo estado debe ser mayor a 0 y menor a 5',
            'nuevo_Estado.numeric' => 'El nuevo estado debe ser numérico',

            'descripcion_Rechazado.required_if' => 'La descripción es requerida para este caso específico',
            'descripcion_Rechazado.min' => 'La descripción no es valida, debe tener al menos 6 caracteres',
            'descripcion_Rechazado.string' => 'La descripción debe ser una cadena de caracteres',

        ];
    }
}
