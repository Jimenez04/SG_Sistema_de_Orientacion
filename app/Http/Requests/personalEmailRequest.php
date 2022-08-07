<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class personalEmailRequest extends FormRequest
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
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            //personal data
            'cedula.required' => 'La cedula es requerida',
            'cedula.min' => 'La cedula no es valida, debe tener al menos 9 caracteres',
            'cedula.max' => 'La cedula no es valida, debe tener maximo 20 caracteres',

            'email.email' => 'El email no es valido',
            'email.required' => 'El email es requerido',

        ];
    }
}
