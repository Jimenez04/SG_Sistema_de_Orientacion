<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class forgetAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize ()
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
            'email' => 'required|email',
            'cedula' => 'required|min:9|max:25',
            'carnet' => 'required|min:4|max:20',
        ];
    }

    public function messages()
    {
        return [
            //user data
            'email.required' => 'El email es requerido',
            'email.email' => 'El email no es valido',

            'cedula.required' => 'La cedula es requerida',
            'cedula.min' => 'La cedula no es valida, debe tener al menos 9 caracteres',
            'cedula.max' => 'La cedula no es valida, debe tener maximo 25 caracteres',

            'carnet.required' => 'El carnet es requerido',
            'carnet.min' => 'El carnet no es valido, debe tener al menos 4 caracteres',
            'carnet.max' => 'El carnet no es valido, debe tener maximo 20 caracteres',
        ];
    }
}
