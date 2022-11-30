<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class resumePAI_request extends FormRequest
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
                'Estudiante.profesor_Consejero' => 'required|min:5|max:254|string',
                
                'PAI.profesional_VidaEstudiantil' => 'required|min:5|max:254|string',
                
                'Curso.numero_De_Culminaciones' => 'required|numeric|min:0|max:100',
                'Curso.aspectos_Y_Condiciones_Rezago' => 'required|string|min:4',
                
                
                'Formulario.cuestionario.*.pregunta_Id' => 'required|numeric|min:1|max:18',
                'Formulario.cuestionario.*.respuesta' => 'required|numeric|min:1|max:5',
                'Formulario.cuestionario' => 'required|array|distinct|min:18|max:18',
                'Formulario' => 'required',


                'PAI.salud_Como_Impedimento' => 'required|numeric|min:0|max:1', 
                'Salud.descipcion' => 'required_if:PAI.salud_Como_Impedimento,==,1|string|min:4', 

                'Curso.actitud_Estudiante' => 'required|numeric|min:0|max:1', 
                'Actitud_En_El_Curso.descripcion' => 'required_if:Curso.actitud_Estudiante,==,1|string|min:4', 

                'Curso.resumen_No_Aprobar_El_Curso' => 'required|string|min:4',

                'PAI.que_Espera_Del_Plan' => 'required|string|min:4',

                'PAI.comentarios_Presentes_Reunion' => 'required|string|min:4',

                'PAI.nombreoficina' => 'required|string|min:4|max:30',
        ];
    }

    public function messages()
    {
        return [
            'Estudiante.profesor_Consejero.required' => 'El campo “profesor consejero” es requerido. ',
            'Estudiante.profesor_Consejero.min' => 'El campo "profesor consejero" debe tener al menos 5 caracteres.',
            'Estudiante.profesor_Consejero.max' => 'El campo “profesor consejero” debe tener menos de 254 caracteres.',
            'Estudiante.profesor_Consejero.string' => 'El campo “profesor consejero” debe ser una cadena de caracteres.',
           
            'PAI.nombreoficina.required' => 'El campo “Nombre de oficina” es requerido. ',
            'PAI.nombreoficina.min' => 'El campo "Nombre de oficina" debe tener al menos 5 caracteres.',
            'PAI.nombreoficina.max' => 'El campo “Nombre de oficina" debe tener menos de 254 caracteres.',
            'PAI.nombreoficina.string' => 'El campo “Nombre de oficina" debe ser una cadena de caracteres.',
           


            'PAI.profesional_VidaEstudiantil.required' => 'El campo “profesional de la coordinación de vida estudiantil” es requerido. ',
            'PAI.profesional_VidaEstudiantil.min' => 'El campo “profesional de la coordinación de vida estudiantil" debe tener al menos 5 caracteres.',
            'PAI.profesional_VidaEstudiantil.max' => 'El campo “profesional de la coordinación de vida estudiantil” debe tener menos de 254 caracteres.',
            'PAI.profesional_VidaEstudiantil.string' => 'El campo “profesional de la coordinación de vida estudiantil” debe ser una cadena de caracteres.',



            'Curso.numero_De_Culminaciones.required' => 'El campo "Número de ocasiones en que ha culminado el curso" es requerido.',
            'Curso.numero_De_Culminaciones.numeric' => 'El campo "Número de ocasiones en que ha culminado el curso" debe ser un número entero.',
            'Curso.numero_De_Culminaciones.min' => 'El campo "Número de ocasiones en que ha culminado el curso" no debe ser menor a 0.',
            'Curso.numero_De_Culminaciones.max' => 'El campo "Número de ocasiones en que ha culminado el curso" no puede ser mayor a 100.',

            'Curso.aspectos_Y_Condiciones_Rezago.required' => 'El campo “aspectos y circunstancias que lo han llevado a la condición de rezago” es requerido. ',
            'Curso.aspectos_Y_Condiciones_Rezago.min' => 'El campo “aspectos y circunstancias que lo han llevado a la condición de rezago" debe tener al menos 4 caracteres.',
            'Curso.aspectos_Y_Condiciones_Rezago.string' => 'El campo “aspectos y circunstancias que lo han llevado a la condición de rezago” debe ser una cadena de caracteres.',




            'Formulario.cuestionario.*.pregunta_Id.required' => 'El campo "id de pregunta" es requerido.',
            'Formulario.cuestionario.*.pregunta_Id.numeric' => 'El campo "id de pregunta" debe ser un número entero.',
            'Formulario.cuestionario.*.pregunta_Id.min' => 'El campo id de pregunta" no debe ser menor a 1.',
            'Formulario.cuestionario.*.pregunta_Id.max' => 'El campo "id de pregunta" no puede ser mayor a 18.',

            'Formulario.cuestionario.*.respuesta.required' => 'El campo "respuesta de pregunta" es requerido.',
            'Formulario.cuestionario.*.respuesta.numeric' => 'El campo "respuesta de pregunta" debe ser un número entero.',
            'Formulario.cuestionario.*.respuesta.min' => 'El campo "respuesta de pregunta" no debe ser menor a 1.',
            'Formulario.cuestionario.*.respuesta.max' => 'El campo "respuesta de pregunta" no puede ser mayor a 5.',

            'Formulario.cuestionario.required' => 'El campo "Valoración" es requerido.',
            'Formulario.cuestionario.array' => 'El campo "Valoración" debe ser un array igual a 18.',
            'Formulario.cuestionario.min' => 'El campo "Valoración" no debe ser menor a 18.',
            'Formulario.cuestionario.max' => 'El campo "Valoración" no puede ser mayor a 18.',
            
            'Formulario.required' => 'El campo "Formulario" es requerido.',


            'PAI.salud_Como_Impedimento.required' => 'El campo "¿Considera que su salud física y/o emocional, le ha perjudicado, y por eso ha perdido el curso?" es requerido.',
            'PAI.salud_Como_Impedimento.numeric' => 'El campo "¿Considera que su salud física y/o emocional, le ha perjudicado, y por eso ha perdido el curso?" debe ser un número entero entre 1 y 0.',
            'PAI.salud_Como_Impedimento.min' => 'El campo "¿Considera que su salud física y/o emocional, le ha perjudicado, y por eso ha perdido el curso?" no debe ser menor a 0.',
            'PAI.salud_Como_Impedimento.max' => 'El campo "¿Considera que su salud física y/o emocional, le ha perjudicado, y por eso ha perdido el curso?" no puede ser mayor a 1.',

            'Salud.descipcion.required_if' => 'El campo "El ¿Por qué? de ¿Considera que su salud física y/o emocional, le ha perjudicado, y por eso ha perdido el curso?" es requerido.',
            'Salud.descipcion.string' => 'El campo "El ¿Por qué? de ¿Considera que su salud física y/o emocional, le ha perjudicado, y por eso ha perdido el curso?" debe ser una cadena de caracteres.',
            'Salud.descipcion.min' => 'El campo "El ¿Por qué? de  ¿Considera que su salud física y/o emocional, le ha perjudicado, y por eso ha perdido el curso?" no debe ser menor a 4.',



            'Curso.actitud_Estudiante.required' => 'El campo "¿Considera que algún aspecto relacionado con su actitud hacia el curso, podria estar influyendo para la aprobación del curso?" es requerido.',
            'Curso.actitud_Estudiante.numeric' => 'El campo "¿Considera que algún aspecto relacionado con su actitud hacia el curso, podria estar influyendo para la aprobación del curso?" debe ser un número entero entre 1 y 0.',
            'Curso.actitud_Estudiante.min' => 'El campo "¿Considera que algún aspecto relacionado con su actitud hacia el curso, podria estar influyendo para la aprobación del curso?" no debe ser menor a 0.',
            'Curso.actitud_Estudiante.max' => 'El campo "¿Considera que algún aspecto relacionado con su actitud hacia el curso, podria estar influyendo para la aprobación del curso?" no puede ser mayor a 1.',

            'Actitud_En_El_Curso.descripcion.required_if' => 'El campo "El ¿Por qué? de ¿Considera que algún aspecto relacionado con su actitud hacia el curso, podria estar influyendo para la aprobación del curso?" es requerido.',
            'Actitud_En_El_Curso.descripcion.string' => 'El campo "El ¿Por qué? de ¿Considera que algún aspecto relacionado con su actitud hacia el curso, podria estar influyendo para la aprobación del curso?" debe ser una cadena de caracteres.',
            'Actitud_En_El_Curso.descripcion.min' => 'El campo "El ¿Por qué? de  ¿Considera que algún aspecto relacionado con su actitud hacia el curso, podria estar influyendo para la aprobación del curso?" no debe ser menor a 4.',

            

            'Curso.resumen_No_Aprobar_El_Curso.required' => 'El campo "Resuma los motivos por los cuales usted cree que no ha aprobado el curso" es requerido.',
            'Curso.resumen_No_Aprobar_El_Curso.string' => 'El campo "Resuma los motivos por los cuales usted cree que no ha aprobado el curso" debe ser una cadena de caracteres.',
            'Curso.resumen_No_Aprobar_El_Curso.min' => 'El campo "Resuma los motivos por los cuales usted cree que no ha aprobado el curso" no puede ser menor a 4 caracteres.',


            'PAI.que_Espera_Del_Plan.required' => 'El campo "¿Qué espera al acogerse al Plan de acción individual?" es requerido.',
            'PAI.que_Espera_Del_Plan.string' => 'El campo "¿Qué espera al acogerse al Plan de acción individual?" debe ser una cadena de caracteres.',
            'PAI.que_Espera_Del_Plan.min' => 'El campo "¿Qué espera al acogerse al Plan de acción individual?" no puede ser menor a 4 caracteres.',
            

            'PAI.comentarios_Presentes_Reunion.required' => 'El campo "Observaciones o comentarios del/de la docente u otros miembros del equipo, presentes en la reunión" es requerido.',
            'PAI.comentarios_Presentes_Reunion.string' => 'El campo "Observaciones o comentarios del/de la docente u otros miembros del equipo, presentes en la reunión." debe ser una cadena de caracteres',
            'PAI.comentarios_Presentes_Reunion.min' => 'El campo "Observaciones o comentarios del/de la docente u otros miembros del equipo, presentes en la reunión" no puede ser menor a 4 caracteres.',

        ];
    }
}
