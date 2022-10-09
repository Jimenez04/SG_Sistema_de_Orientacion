<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewNecesidadYApoyoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
            return [
                'necesidad_Apoyo.diagnostico' => 'required_with:necesidad_Apoyo.area_Profesional,necesidad_Apoyo.descripcion_Seguimiento,necesidad_Apoyo.profesional_Que_Diagnostica,necesidad_Apoyo.descripcion_Atencion|min:6|max:254|string',

                'necesidad_Apoyo.profesional_Que_Diagnostica' => 'required_with:necesidad_Apoyo.area_Profesional,necesidad_Apoyo.descripcion_Seguimiento,necesidad_Apoyo.diagnostico,necesidad_Apoyo.descripcion_Atencion|min:6|max:254|string',

                'necesidad_Apoyo.area_Profesional' =>  'required_with:necesidad_Apoyo.profesional_Que_Diagnostica,necesidad_Apoyo.descripcion_Seguimiento,necesidad_Apoyo.diagnostico,necesidad_Apoyo.descripcion_Atencion|min:6|max:254|string',

                'necesidad_Apoyo.descripcion_Seguimiento' =>   'required_with:necesidad_Apoyo.area_Profesional,necesidad_Apoyo.diagnostico,necesidad_Apoyo.profesional_Que_Diagnostica,necesidad_Apoyo.descripcion_Atencion|min:6|max:254|string',

                'necesidad_Apoyo.descripcion_Atencion' =>     'required_with:necesidad_Apoyo.area_Profesional,necesidad_Apoyo.diagnostico,necesidad_Apoyo.profesional_Que_Diagnostica,necesidad_Apoyo.descripcion_Seguimiento|min:6|max:254|string',
            ];
    }

    public function messages()
    {
        return [
            'necesidad_Apoyo.diagnostico.required_with' =>  'El campo "Diagnóstico" es obligatorio.',
            'necesidad_Apoyo.diagnostico.min' =>  'El campo “Diagnóstico” debe contener al menos 6 caracteres.
            ',
            'necesidad_Apoyo.diagnostico.max' =>  'El campo “Diagnóstico” debe contener menos  de 254 caracteres.',
            'necesidad_Apoyo.diagnostico.string' =>  'El campo “Diagnóstico” debe ser una cadena de caracteres.',

            'necesidad_Apoyo.profesional_Que_Diagnostica.required_with' =>  'El campo "Profesional que diagnostica" es obligatorio.',
            'necesidad_Apoyo.profesional_Que_Diagnostica.min' =>  'El campo “Profesional que diagnostica” debe contener al menos 6 caracteres.',
            'necesidad_Apoyo.profesional_Que_Diagnostica.max' =>  'El campo "Profesional que diagnostica” debe contener menos de 254 caracteres.',
            'necesidad_Apoyo.profesional_Que_Diagnostica.string' =>  'El campo “Profesional que diagnostica” debe ser una cadena de caracteres.',

            'necesidad_Apoyo.area_Profesional.required_with' =>  'El campo "Área profesional" es obligatorio.',
            'necesidad_Apoyo.area_Profesional.min' =>  'El campo “Área profesional” debe contener al menos 6 caracteres.',
            'necesidad_Apoyo.area_Profesional.max' =>  'El campo "El campo “Área profesional” debe contener menos de 254 caracteres.',
            'necesidad_Apoyo.area_Profesional.string' =>  'El campo “Área profesional” debe ser una cadena de caracteres.',

            'necesidad_Apoyo.descripcion_Seguimiento.required_with' =>  'El campo "Descripción de seguimiento" es obligatorio.',
            'necesidad_Apoyo.descripcion_Seguimiento.min' =>  'El campo “Descripción de seguimiento” debe contener al menos 6 caracteres.',
            'necesidad_Apoyo.descripcion_Seguimiento.max' =>  'El campo "El campo “Descripción de seguimiento” debe contener menos de 254 caracteres.',
            'necesidad_Apoyo.descripcion_Seguimiento.string' =>  'El campo “Descripción de seguimiento” debe ser una cadena de caracteres.',

            'necesidad_Apoyo.descripcion_Atencion.required_with' =>  'El campo "Descripción de atención" es obligatorio.',
            'necesidad_Apoyo.descripcion_Atencion.min' =>  'El campo “Descripción de atención” debe contener al menos 6 caracteres.',
            'necesidad_Apoyo.descripcion_Atencion.max' =>  'El campo "El campo “Descripción de atención” debe contener menos de 254 caracteres.',
            'necesidad_Apoyo.descripcion_Atencion.string' =>  'El campo “Descripción de atención” debe ser una cadena de caracteres.',


        ];
    }
}
