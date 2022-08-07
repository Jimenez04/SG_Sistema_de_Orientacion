<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
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
            //personal data
            'cedula' => 'required|unique:personas|min:9|max:20',
            'nombre1' => 'required|min:3|max:20|string',
            'nombre2' => 'min:3|max:20|string|nullable',
            'apellido1' => 'required|min:3|max:20|string',
            'apellido2' => 'required|min:3|max:20|string',
            'fecha_Nacimiento' => 'required|date_format:Y-m-d', //investigar
            'sexo_id' => 'required|integer|min:1|max:2',

            //user data
            'email' => 'required|unique:users|email|regex:/(.*)@ucr.ac.cr/i',
            'password_' => 'required|min:6|max:25|same:c_password',
            'c_password' => 'required|min:6|max:25',
        ];
    }

    public function messages()
    {
        return [
            //personal data
            'cedula.required' => 'La cedula es requerida',
            'cedula.min' => 'La cedula no es valida, debe tener al menos 9 caracteres',
            'cedula.max' => 'La cedula no es valida, debe tener maximo 20 caracteres',
            'cedula.unique' => 'La cedula ya se encuentra registrada',
            
            'nombre1.required' => 'El primer nombre es requerido',
            'nombre1.min' => 'El primer nombre no es valido, debe tener al menos 3 caracteres',
            'nombre1.max' => 'El primer nombre no es valido, debe tener maximo 20 caracteres',
            'nombre1.string' => 'El primer nombre no tiene un formato valido',
            
            'nombre2.min' => 'El segundo nombre no es valido, debe tener al menos 3 caracteres',
            'nombre2.max' => 'El segundo nombre no es valido, debe tener maximo 20 caracteres',
            'nombre2.string' => 'El segundo nombre no tiene un formato valido',
            
            'apellido1.required' => 'El primer apellido es requerido',
            'apellido1.min' => 'El primer apellido no es valido, debe tener al menos 3 caracteres',
            'apellido1.max' => 'El primer apellido no es valido, debe tener maximo 20 caracteres',
            'apellido1.string' => 'El primer apellido no tiene un formato valido',
            
            'apellido2.required' => 'El segundo apellido es requerido',
            'apellido2.min' => 'El segundo apellido no es valido, debe tener al menos 3 caracteres',
            'apellido2.max' => 'El segundo apellido no es valido, debe tener maximo 20 caracteres',
            'apellido2.string' => 'El segundo apellido no tiene un formato valido',
            
            'fecha_Nacimiento.required' => 'La fecha de nacimiento es requerida',
            'fecha_Nacimiento.date_format' => 'La fecha de nacimiento no tiene un formato valido',

            'sexo_id.required' => 'El sexo es requerido',
            'sexo_id.min' => 'El sexo no es valido',
            'sexo_id.max' => 'El sexo no es valido',
            'sexo_id.integer' => 'El sexo no tiene un formato valido',


            //user data
            'email.required' => 'El email es requerido',
            'email.regex' => 'El email indicado no es valido',
            'email.email' => 'El email no es valido',
            'email.unique' => 'El email ya se encuentra registrado',

            'password_.required' => 'La contraseña es requerida',
            'password_.min' => 'La contraseña debe tener al menos 6 caracteres',
            'password_.max' => 'La contraseña debe tener menos de 25 caracteres',
            
            'c_password.required' => 'La contraseña es requerida',
            'c_password.min' => 'La contraseña debe tener al menos 6 caracteres',
            'c_password.max' => 'La contraseña debe tener menos de 25 caracteres',
            'password_.same' => 'La contraseña y su confirmación deben coincidir',
        ];
    }
}
