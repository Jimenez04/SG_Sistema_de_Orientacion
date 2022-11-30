<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class preguntasPlanDeAccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'id' => "1",
            'nombre' => "Desempeño en el curso",
        ]);
        
        DB::table('categorias')->insert([
            'id' => "2",
            'nombre' => "Estrategias de estudio",
        ]);
        
        DB::table('categorias')->insert([
            'id' => "3",
            'nombre' => "Para los Exámenes y/o durante éstos",
        ]);
//preguntas
        //Desempeño en el curso
        DB::table('preguntas__valoracions')->insert([
            'pregunta' => "Se le dificultan los contenidos",
            'categoria_Id' => "1",
        ]);

        DB::table('preguntas__valoracions')->insert([
            'pregunta' => "Asiste a clases",
            'categoria_Id' => "1",
        ]);
        
        DB::table('preguntas__valoracions')->insert([
            'pregunta' => "Comprende los contenidos impartidos por los y las docentes",
            'categoria_Id' => "1",
        ]);
        
        DB::table('preguntas__valoracions')->insert([
            'pregunta' => "¿Le ve utilidad al curso en su formación académica?",
            'categoria_Id' => "1",
        ]);

         //Estrategias de estudios
         DB::table('preguntas__valoracions')->insert([
            'pregunta' => "Organiza su tiempo para estudiar: horario, planificador, agenda",
            'categoria_Id' => "2",
        ]);

        DB::table('preguntas__valoracions')->insert([
            'pregunta' => "Consulta los libros de texto u otras fuentes que se definen en el programa del curso",
            'categoria_Id' => "2",
        ]);

        DB::table('preguntas__valoracions')->insert([
            'pregunta' => "Consulta el material recomendado (plataforma, videos, otros libros)",
            'categoria_Id' => "2",
        ]);

        DB::table('preguntas__valoracions')->insert([
            'pregunta' => "Asiste a horas de consulta con el profesor",
            'categoria_Id' => "2",
        ]);

        DB::table('preguntas__valoracions')->insert([
            'pregunta' => "Usa los servicios de apoyo académico: Banco de exámenes, estudianderos, repasos, tuturías",
            'categoria_Id' => "2",
        ]);

        DB::table('preguntas__valoracions')->insert([
            'pregunta' => "Utiliza apoyo de tutor u otros apoyos privados",
            'categoria_Id' => "2",
        ]);

        DB::table('preguntas__valoracions')->insert([
            'pregunta' => "Participa en grupos de estudios organizados por los estudiantes",
            'categoria_Id' => "2",
        ]);

        //Para los exámenes y/o durante éstos
         DB::table('preguntas__valoracions')->insert([
            'pregunta' => "Borra o tacha constantemente",
            'categoria_Id' => "3",
        ]);
        
        DB::table('preguntas__valoracions')->insert([
            'pregunta' => "Se bloquea",
            'categoria_Id' => "3",
        ]);

        DB::table('preguntas__valoracions')->insert([
            'pregunta' => "Se pone nervioso/a y angustiado/a durante la prueba",
            'categoria_Id' => "3",
        ]);
        
        DB::table('preguntas__valoracions')->insert([
            'pregunta' => "Considera que el nivel de dificultad de los ítemes en el examen es mayor al nivel de dificultad de los ítemes vistos en clase",
            'categoria_Id' => "3",
        ]);

        DB::table('preguntas__valoracions')->insert([
            'pregunta' => "Cree que le fue bien, pero obtiene una nota inferior a la esperada",
            'categoria_Id' => "3",
        ]);

        DB::table('preguntas__valoracions')->insert([
            'pregunta' => "Cuando recibe el examen calificado: ¿Revisa los señalamientos académicos del docente?",
            'categoria_Id' => "3",
        ]);

        DB::table('preguntas__valoracions')->insert([
            'pregunta' => "Cuando recibe el examen calificado: Analiza los errores en sus respuestas y los corrije",
            'categoria_Id' => "3",
        ]);
        
    }
}
