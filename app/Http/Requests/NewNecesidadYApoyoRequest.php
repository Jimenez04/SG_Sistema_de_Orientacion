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
                'necesidad_Apoyo.diagnostico' => 'min:6|max:254|string', //4

                'necesidad_Apoyo.area_Profesional' =>  'min:6|max:254|string', //3

                'necesidad_Apoyo.recibe_atencionyseguimiento' =>  'required_with:necesidad_Apoyo.diagnostico|numeric|min:0|max:1', //4

                'necesidad_Apoyo.atencionyseguimiento' =>     'required_if:necesidad_Apoyo.recibe_atencionyseguimiento,==,1|min:6|string', //3
            ];
    }

    public function messages()
    {
        return [
            //'necesidad_Apoyo.diagnostico.required' =>  'El campo "Diagnóstico" es obligatorio.',
            'necesidad_Apoyo.diagnostico.min' =>  'El campo “Diagnóstico” debe contener al menos 6 caracteres.',
            'necesidad_Apoyo.diagnostico.max' =>  'El campo “Diagnóstico” debe contener menos  de 254 caracteres.',
            'necesidad_Apoyo.diagnostico.string' =>  'El campo “Diagnóstico” debe ser una cadena de caracteres.',

            //'necesidad_Apoyo.area_Profesional.required_with' =>  'El campo "Área profesional" es obligatorio.',
            'necesidad_Apoyo.area_Profesional.min' =>  'El campo “Área profesional” debe contener al menos 6 caracteres.',
            'necesidad_Apoyo.area_Profesional.max' =>  'El campo "El campo “Área profesional” debe contener menos de 254 caracteres.',
            'necesidad_Apoyo.area_Profesional.string' =>  'El campo “Área profesional” debe ser una cadena de caracteres.',

            'necesidad_Apoyo.recibe_atencionyseguimiento.required' =>  'El campo "recibe atención y seguimiento" es obligatorio.',
            'necesidad_Apoyo.recibe_atencionyseguimiento.min' =>  'El campo “recibe atención y seguimiento” debe ser falso o verdadero.',
            'necesidad_Apoyo.recibe_atencionyseguimiento.max' =>  'El campo “recibe atención y seguimiento” debe ser falso o verdadero.',
            'necesidad_Apoyo.recibe_atencionyseguimiento.numeric' =>  'El campo “recibe atención y seguimiento” debe ser un entero.',
            
            
            'necesidad_Apoyo.atencionyseguimiento.required_if' =>  'El campo "Tipo atención y seguimiento" es obligatorio.',
            'necesidad_Apoyo.atencionyseguimiento.min' =>  'El campo “Tipo atención y seguimiento” debe contener al menos 6 caracteres.',
            'necesidad_Apoyo.atencionyseguimiento.string' =>  'El campo “Tipo atención y seguimiento” debe ser una cadena de caracteres.',


        ];
    }
}
