<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewInstitucionDeProcedenciaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
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
                'institucion.nombre' => 'required|min:6|max:254|string',
                'institucion.ano_egreso' => 'required|date_format:Y-m-d',
                'institucion.ano_ingreso_universidad' => 'required|date_format:Y-m-d',
            ];
    }

    public function messages()
    {
        return [
            'institucion.nombre.required' => 'El nombre de la institución es requerido.',
            'institucion.nombre.string' => 'El campo nombre de la institución debe ser una cadena de caracteres.',
            'institucion.nombre.min' => 'El campo nombre no debe ser menor a 6 caracteres.',
            'institucion.nombre.max' => 'El campo nombre no puede ser mayor a 254 caracteres.',
            
            'institucion.ano_egreso.required' => 'El año de egreso es requerido',
            'institucion.ano_egreso.date_format' => 'El año de egreso no tiene un formato valido',
            
            'institucion.ano_ingreso_universidad.required' => 'El año de egreso es requerido',
            'institucion.ano_ingreso_universidad.date_format' => 'El año de egreso no tiene un formato valido',
        ];
    }
}
