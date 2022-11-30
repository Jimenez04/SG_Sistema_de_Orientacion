<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class newPAI_request extends FormRequest
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
                'solicitud.nombre_Curso' => 'required|min:5|max:254|string',
                'solicitud.numero_De_Matriculas' => 'required|numeric|min:2|max:100',
                'solicitud.resumen_No_Aprobar_El_Curso' => 'required|string|min:4',
                'solicitud.grupo' => 'required|numeric|min:1|max:10',
                'solicitud.docente' => 'required|string|min:4|max:250',


                'solicitud.semestre' => 'required|numeric|min:1|max:3',
                'solicitud.nombre_Carrera' => 'required|string|min:4|max:250',
        ];
    }

    public function messages()
    {
        return [
            'solicitud.nombre_Curso.required' => 'El campo “nombre de curso” es requerido. ',
            'solicitud.nombre_Curso.min' => 'El campo "nombre de curso" debe tener al menos 5 caracteres.',
            'solicitud.nombre_Curso.max' => 'El campo “nombre de curso” debe tener menos de 254 caracteres.',
            'solicitud.nombre_Curso.string' => 'El campo “nombre de curso” debe ser una cadena de caracteres.',

            'solicitud.semestre.required' => 'El campo "Número de semestre" es requerido.',
            'solicitud.semestre.numeric' => 'El campo "Número de semestre" debe ser un número entre 1 y 3.',
            'solicitud.semestre.min' => 'El campo "Número de semestre" no debe ser menor a 1.',
            'solicitud.semestre.max' => 'El campo "Número de semestre" no puede ser mayor a 3.',
           
            'solicitud.numero_De_Matriculas.required' => 'El campo "número de ocasiones matriculado el curso" es requerido.',
            'solicitud.numero_De_Matriculas.numeric' => 'El campo "número de ocasiones matriculado el curso" debe ser un número entre 1 y 100.',
            'solicitud.numero_De_Matriculas.min' => 'El campo "número de ocasiones matriculado el curso" no debe ser menor a 2.',
            'solicitud.numero_De_Matriculas.max' => 'El campo "número de ocasiones matriculado el curso" no puede ser mayor a 100.',

            'solicitud.resumen_No_Aprobar_El_Curso.required' => 'El campo "razones de no aprobar el curso" es requerido.',
            'solicitud.resumen_No_Aprobar_El_Curso.string' => 'El campo "razones de no aprobar el curso" debe ser una cadena de caracteres.',
            'solicitud.resumen_No_Aprobar_El_Curso.min' => 'El campo "razones de no aprobar el curso" no puede ser menor a 4 caracteres.',

            'solicitud.grupoCurso.required' => 'El campo "grupo de curso" es requerido.',
            'solicitud.grupoCurso.numeric' => 'El campo "grupo de curso" debe ser un número entre 1 y 100.',
            'solicitud.grupoCurso.min' => 'El campo "grupo de curso" no debe ser menor a 1.',
            'solicitud.grupoCurso.max' => 'El campo "grupo de curso" no puede ser mayor a 10.',

            'solicitud.docente.required' => 'El campo "tutor del curso" es requerido.',
            'solicitud.docente.string' => 'El campo "tutor del curso" debe ser una cadena de caracteres.',
            'solicitud.docente.max' => 'El campo "tutor del curso" no puede ser mayor a 250 caracteres.',
            'solicitud.docente.min' => 'El campo "tutor del curso" no puede ser menor a 4 caracteres.',
            
            'solicitud.nombre_Carrera.required' => 'El campo "nombre carrera" es requerido.',
            'solicitud.nombre_Carrera.string' => 'El campo "nombre carrera" debe ser una cadena de caracteres.',
            'solicitud.nombre_Carrera.max' => 'El campo "nombre carrera" no puede ser mayor a 250 caracteres.',
            'solicitud.nombre_Carrera.min' => 'El campo "nombre carrera" no puede ser menor a 4 caracteres.',
        ];
    }
}
