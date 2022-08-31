<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class update_Personal_Information_request extends FormRequest
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
            'nombre1' => 'min:3|max:20|string',
            'nombre2' => 'min:3|max:20|string|nullable',
            'apellido1' => 'min:3|max:20|string',
            'apellido2' => 'min:3|max:20|string',
            'fecha_Nacimiento' => 'date_format:Y-m-d', 
            'sexo_id' => 'integer|min:1|max:2',
        ];
    }
    public function messages()
    { 
        return [
            'cedula.required' => 'La cedula es requerida',
            'cedula.min' => 'La cedula no es valida, debe tener al menos 9 caracteres',
            'cedula.max' => 'La cedula no es valida, debe tener maximo 20 caracteres',
            
            'nombre1.min' => 'El primer nombre no es valido, debe tener al menos 3 caracteres',
            'nombre1.max' => 'El primer nombre no es valido, debe tener maximo 20 caracteres',
            'nombre1.string' => 'El primer nombre no tiene un formato valido',
            
            'nombre2.min' => 'El segundo nombre no es valido, debe tener al menos 3 caracteres',
            'nombre2.max' => 'El segundo nombre no es valido, debe tener maximo 20 caracteres',
            'nombre2.string' => 'El segundo nombre no tiene un formato valido',
            
            'apellido1.min' => 'El primer apellido no es valido, debe tener al menos 3 caracteres',
            'apellido1.max' => 'El primer apellido no es valido, debe tener maximo 20 caracteres',
            'apellido1.string' => 'El primer apellido no tiene un formato valido',
            
            'apellido2.min' => 'El segundo apellido no es valido, debe tener al menos 3 caracteres',
            'apellido2.max' => 'El segundo apellido no es valido, debe tener maximo 20 caracteres',
            'apellido2.string' => 'El segundo apellido no tiene un formato valido',
            
            'fecha_Nacimiento.required' => 'La fecha de nacimiento es requerida',
            'fecha_Nacimiento.date_format' => 'La fecha de nacimiento no tiene un formato valido',

            'sexo_id.min' => 'El sexo no es valido',
            'sexo_id.max' => 'El sexo no es valido',
            'sexo_id.integer' => 'El sexo no tiene un formato valido',
        ];
    }
}
