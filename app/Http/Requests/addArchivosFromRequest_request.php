<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addArchivosFromRequest_request extends FormRequest
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
    public function rules() : array
    {
        return [
            'archivos.*.expedidoPor' => 'required_with:archivos.*.archivo64|string|min:4|max:100',
            'archivos.*.archivo64' => 'required_with:archivos.*.expedidoPor|base64file|base64max:10000',
            'archivos.*.nombre' => 'required_with:archivos.*.archivo64|string|max:40',
        ];
    }

    public function messages()
    {
        return [
            //user data
            'archivos.*.expedidoPor.required_with' => 'El campo expedido por es requerido.',
            'archivos.*.expedidoPor.string' => 'El campo expedido por debe ser una cadena de caracteres.',
            'archivos.*.expedidoPor.min' => 'El campo “expedido por” debe contener al menos 4 caracteres.',
            'archivos.*.expedidoPor.max' => 'El campo “expedido por” debe contener menos de 100 caracteres.',
            
            'archivos.*.nombrePDF.required_with' => 'El campo nombre de PDF por es requerido.',
            'archivos.*.nombrePDF.string' => 'El campo  nombre de PDF debe ser una cadena de caracteres.',
            'archivos.*.nombrePDF.min' => 'El campo “ nombre de PDF” debe contener al menos 4 caracteres.',
            'archivos.*.nombrePDF.max' => 'El campo “ nombre de PDF” debe contener menos de 100 caracteres.',

            'archivos.*.archivo64.required_with' => 'El archivo es requerido.',
            'archivos.*.archivo64.base64file' => 'El archivo debe ser en formato "Base 64".',
            'archivos.*.archivo64.base64size' => 'El archivo no debe pesar más de 10MB.',
            'archivos.*.archivo64.base64max' => 'El archivo no debe pesar más de 10MB.',

            
        ];
    }
}
