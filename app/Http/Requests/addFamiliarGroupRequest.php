<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addFamiliarGroupRequest extends FormRequest
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
            'grupoFamiliar.descripcion_De_Discapacidades' => 'required|min:10|max:254|string',

            'grupoFamiliar.pariente.*.tipo_Pariente' => 'required|min:2|max:20|string',
            'grupoFamiliar.pariente.*.discapacidad_Si_Presenta' => 'required|min:2|max:20|string',
            'grupoFamiliar.pariente.*.persona_cedula' => 'required|min:9|max:20|string|exists:personas,cedula',
        ];
    }

    public function messages()
    {
        return  [
            'grupoFamiliar.descripcion_De_Discapacidades.required'  =>  'El campo descripción de discapacidades es obligatorio.',
            'grupoFamiliar.descripcion_De_Discapacidades.string'  =>  'El campo debe ser una cadena de caracteres.',
            'grupoFamiliar.descripcion_De_Discapacidades.min'  =>  'El campo debe ser mayor a 9 caracteres.',
            'grupoFamiliar.descripcion_De_Discapacidades'  =>  'El campo debe ser menor a 255 caracteres.',

            'grupoFamiliar.pariente.*.cedula.required'  =>  'El campo cédula es obligatorio.',
            'grupoFamiliar.pariente.*.cedula.exists'  =>  'La persona no se encuentra en el sistema, regístrela e inténtelo nuevamente.',
            'grupoFamiliar.pariente.*.cedula.string'  =>  'El campo cédula debe ser una cadena de caracteres.',
            'grupoFamiliar.pariente.*.cedula.max'  =>  'El campo cédula debe ser mayor a 8 caracteres.',
            'grupoFamiliar.pariente.*.cedula.min'  =>  'El campo cédula debe ser menor a 21 caracteres.',

            'grupoFamiliar.pariente.*.relacion.required'  =>  'El campo relación es obligatorio.',
            'grupoFamiliar.pariente.*.relacion.string'  =>  'El campo relación debe ser una cadena de caracteres.',
            'grupoFamiliar.pariente.*.relacion.max'  =>  'El campo relación debe ser mayor a 8 caracteres.',
            'grupoFamiliar.pariente.*.relacion.min'  =>  'El campo relación debe ser menor a 21 caracteres.',

            'grupoFamiliar.pariente.*.discapacidad_Si_Presenta.required'  =>  'El campo "presenta discapacidad" es obligatorio.',
            'grupoFamiliar.pariente.*.discapacidad_Si_Presenta.string'  =>  'El campo "presenta discapacidad" debe ser una cadena de caracteres.',
            'grupoFamiliar.pariente.*.discapacidad_Si_Presenta.max'  =>  'El campo "presenta discapacidad" debe ser mayor a 8 caracteres.',
            'grupoFamiliar.pariente.*.discapacidad_Si_Presenta.min'  =>  'El campo "presenta discapacidad"debe ser menor a 21 caracteres.',
        ];
    }
}
