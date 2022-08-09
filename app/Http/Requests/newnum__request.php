<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class newnum__request extends FormRequest
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
            'cedula' => 'required|min:9|max:20',
            'numero' => 'required|numeric|digits_between:6,40',
        ];
    }

    public function messages()
    {
        return [
            //user data
            'cedula.required' => 'La cédula es requerida',
            'cedula.min' => 'La cedula no es valida, debe tener al menos 9 caracteres',
            'cedula.max' => 'La cedula no es valida, debe tener maximo 20 caracteres',

            'numero.required' => 'El número es requerido',
            'numero.digits_between' => 'El número debe tener al menos 6 dígitos y menos de 40',
            'numero.numeric' => 'El número debe ser un número entero',
        ];
    }
}
