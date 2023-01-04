<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class changePasswordRequest extends FormRequest
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
            'email' => 'required|email|regex:/(.*)@ucr.ac.cr/i',
            'new_password_' => 'required|min:6|max:25|same:new_c_password_',
            'new_c_password_' => 'required|min:6|max:25',
            'old_password_' => 'required|min:6|max:25',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El email es requerido',
            'email.regex' => 'El email indicado no es valido',
            'email.email' => 'El email no es valido',
            'email.unique' => 'El email ya se encuentra registrado',

            'new_password_.required' => 'La nueva contraseña es requerida',
            'new_password_.min' => 'La nueva contraseña debe tener al menos 6 caracteres',
            'new_password_.max' => 'La nueva contraseña debe tener menos de 25 caracteres',
            
            'new_c_password_.required' => 'La contraseña de confirmación es requerida',
            'new_c_password_.min' => 'La contraseña de confirmación debe tener al menos 6 caracteres',
            'new_c_password_.max' => 'La contraseña de confirmación debe tener menos de 25 caracteres',
            'new_password_.same' => 'La contraseña y su confirmación deben coincidir',
             'new_c_password_.same' => 'La contraseña y su confirmación deben coincidir',
             
            'old_password_.required' => 'La última contraseña es requerida',
            'old_password_.min' => 'La última contraseña debe tener al menos 6 caracteres',
            'old_password_.max' => 'La última contraseña debe tener menos de 25 caracteres',
            
        ];
    }
}

