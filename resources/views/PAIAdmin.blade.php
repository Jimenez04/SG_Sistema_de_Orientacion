<?php
use Carbon\Carbon;    
 use App\Models\Plan_De_Accion_Individual;
 use App\Models\Categoria;
$imgPath = public_path('storage/img/firma-horizontal-dos-lineas-cmky.jpg');
$img = base64_encode(file_get_contents($imgPath));
//$solicitud = Plan_De_Accion_Individual::all()->first();
//$solicitud = (Plan_De_Accion_Individual::where('numero_Solicitud','PAI_A2022M11E504250352SII' )->first());
?>
<html>
    <head>
        <style>
            @page {
                position: relative;
                max-width: 100%;
                
            }
            body{
                line-height : 20px;
                margin: 100px 50px 20px 50px;
            }
            section{
                margin-top: 25px;
            }
            h1,h2,h3, h4,p, span, label{
                /* text-align: justify; */
                /* text-justify: inter-word; */
                font-weight: normal;
                line-height : 2;
                letter-spacing: 1.2px;
                margin: 0;
            }
            h1,h2,h3,h4{
                text-transform: uppercase;
            }
            h1{
                font-size: 22px;
                font-weight: bold;
                margin: 15px 0 15px 0;
            }
            h1.main-title{
                text-align: center;
                width: 100%;
            }
            h2{
                font-size: 18px;
                margin: 0;
                margin: 15px 0 15px 0;
            }
            span{
                font-size: 14px;
            }
            h3{
                font-size: 16px;
                font-weight: 400;
                margin: 5px 0 5px 0;
                /* line-height : 5px; */
            }
            h4{
                text-transform: none;
            }
            p{
                font-size: 14px;
                white-space: pre-line;
                margin: 0;
            }
            label{
                font-size: 14px;
                line-height : 20px;
            }
            .container-footer-header{
                height: 100px;
                margin: 0;
                padding: 0;
            }
            header {
                position: fixed;
                top: -10px;
            }
            footer {
                position: fixed;
                bottom: -75px;
                width:85%;
            }
            .footer-container{
                justify-content: space-between; 
                width:100%;
            }
            .footer-container > div{
                max-width:50%;
                display: inline-block;
            }
            img{
                width: 200px;
                height: 90px;
            }

            main { 
                page-break-after: always;
                
               }
            main:last-child { 
                page-break-after: never;
             }
             .border{
                border: black 1px;
                border-style: solid;
             }
             

             #encabezado-principal{
                text-align: center;
             }
             #encabezado-principal h3{
                margin: 20px 0 5px 0;
            }
            #encabezado-principal h1{
                margin-top:  0;
            }

            #valoracion-situacion{
                margin-top: 30px ;
            }
            span{
                display: inline-block;
                border-bottom: 1px solid;
                min-width: 100px;
                
                text-align: start;
                padding-left: 8px;
                
            }
            #aspectosValorar p{
                min-width: 100%;
                text-indent: 8px;
                white-space: pre-wrap;
            }
            table{
                width:100%;
            }
            table{
                border-collapse: collapse;
            }
            table td{
                height: 30px;
            }
            table .small-row td{
                height: 14px;
            }
            table .small-row td:first-of-type{
               border-top: 0;
            }
            table .small-row td{
                text-align: center;
                font-size: 12px;
                vertical-align: middle;
                max-height: 1px !important;
            }
            
            table td, table th {
            border: .5px solid black;
            vertical-align: middle;
            }
            .pregunta .center{
                text-align: center;
            }
            table td:nth-child(1){
                padding-left: 8px;
            }
           .contenedores p{
            width: 100%;
            min-height: 130px;
            margin-top: 20px;
            padding: 10px;
            text-indent: 8px;
           }
           .border{
                border: black 1px;
                border-style: solid;
             }

        </style>
    </head>
    
    <body>
        <header class="container-footer-header">
            <div class="flex header-container">
                <div class="first-child child">
                    <img alt="Logo UCR" src="data:image/png;base64, {{ $img }}"> 
                </div>
            </div>
        </header>

        <footer class="container-footer-header" >
            <hr>
            <div class="flex footer-container" style="display:block; ">
                <div style="width:50%; display:inline-block">
                    <Label>Teléfono: </Label> <label style="font-size: 12px;">2511-9576</label>
                </div>
                <div style="width:50%;   display:inline; text-align:end; margin-top:-8px;">
                    <Label>Correo electrónico: </Label><label style="font-size: 12px;">orientacion.sg@ucr.ac.cr</label>
                </div>
            </div>
        </footer>

        <main>
            <section id="encabezado-principal">
                <h1>Plan de acción individual</h1>
                <h2>ART .36bis, 36 ter,</h2>
                <h3 for="" style="line-height:1;">Reglamento del Régimen Acedémico Estudiantil</h3>
                <h1 for="" style="line-height:1;">VALORACIÓN DE SITUACIÓN ACADÉMICA</h1>
            </section>
            <section id="valoracion-situacion">
                <div>
                    <label for="">Fecha: <span>{{Carbon::now()->format('d-m-Y')}}</span> </label>
                    <label for="">Carné: <span>{{$solicitud->Estudiante->carnet}}</span></label>
                    <label for="">Semestre: <span>{{$solicitud->semestre}}</span> </label>
                    <label for="" style="display: block; " >Estudiante: <span style="width: 75%; text-align: start; padding-left: 18px;">{{$solicitud->Estudiante->Persona->nombre1}}  {{$solicitud->Estudiante->Persona->nombre2 }} {{$solicitud->Estudiante->Persona->apellido1 }} {{$solicitud->Estudiante->Persona->apellido2 }} </span></label>
                    <label for="">Carrera: <span style="width: 35%">{{$solicitud->nombre_Carrera}}</span></label>
                    <label for="">Teléfono: <span style="width: 35%">
                    {{$solicitud->Estudiante->Persona->Contacto->first()  != null ?
                     $solicitud->Estudiante->Persona->Contacto->first()->numero : 
                     'No aplica' }}</span></label>
                    <label  for="" style="display: block;">Correo: <span style="width: 80%; text-align: start; padding-left: 8px;">{{$solicitud->Estudiante->Persona->User->email }}</span></label>
                    <p>Para identificar las situaciones que afectan el rendimiento académico del/la estudiante en el curso: <span>{{$solicitud->Curso_Rezago->nombre_Curso}} </span>, con el fin de definir el Plan de Acción Individual, se reúnen en la Oficina de: <span>{{$solicitud->nombreoficina}}</span> , las siguientes personas:</p>
                    <label for="" style="display: block; ">Docente del curso: <span> {{$solicitud->Curso_Rezago->docente}} </span></label>
                    <label for="" style="display: block; ">Profesor Consejero:  <span> {{$solicitud->Estudiante->profesor_Consejero}} </span></label>
                    <label for="" style="display: block; ">Profesional de la Coordinación de Vida Estudiantil: <span></span></label>
                    <label for="" style="display: block;  ">Estudiante: <span>{{$solicitud->Estudiante->Persona->nombre1}}  {{$solicitud->Estudiante->Persona->nombre2 }} {{$solicitud->Estudiante->Persona->apellido1 }} {{$solicitud->Estudiante->Persona->apellido2 }}</span>.</label>
                </div>
            </section>

            <section id="aspectosValorar" style="margin-top: 10px" class="" >
                <h1 style="margin-top: 0;">ASPECTOS A VALORAR</h1>
                <label for="" style="display: block; margin-bottom:5px;">1- Número de ocasiones en que ha matriculado el curso: <span> {{$solicitud->Curso_Rezago->numero_De_Matriculas}} </span></label>

                <label for=""  style="display: block; margin-bottom:5px;">2- Número de ocasiones en que ha culminado el curso: <span> {{$solicitud->Curso_Rezago->numero_De_Culminaciones}} </span></label>
                <label for=""  style="display: block ;">3- Aspectos y circunstancias que lo han llevado a la condición de rezago: </label>
                <p style="margin:0">-{{$solicitud->Curso_Rezago->aspectos_Y_Condiciones_Rezago}}</p>
            </section>
        </main>

        <main>
            <section>
                <h1 style="font-weight: 700; margin: 15px 0 15px 0; font-size: 18px;">Instrucciones</h1>
                <p>En el siguiente cuadro indique su valoración de cada aspecto según la escala de 1 a 5, en donde 1 equivale al nivel MÁS BAJO o poco precuente y 5 al nivel MÁS ALTO o muy frecuente.</p>
                
                <table>
                    <tr style="background-color: lightgreen;">
                        <td colspan="1" style="border-bottom:0 ; text-align: center"  > <b>Aspectos a considerar</b> </td>
                        <td colspan="5" style="text-align: center;">Valoración</td>
                    </tr>
                    <tr class="small-row" style="background-color: lightgreen;">
                        <td colspan="1" class="sin-borde" style="border-top:0 ;"></td>
                        <td colspan="1">1</td>
                        <td colspan="1">2</td>
                        <td colspan="1">3</td>
                        <td colspan="1">4</td>
                        <td colspan="1">5</td>
                    </tr>
                   
                    @foreach (Categoria::orderBy('id', 'ASC')->get() as $item )
                    <tr style="background-color: lightblue;">
                        <td colspan="1">{{$item->id}}- {{$item->nombre}}:</td>
                        <td colspan="1"></td>
                        <td colspan="1"></td>
                        <td colspan="1"></td>
                        <td colspan="1"></td>
                        <td colspan="1"></td>
                    </tr>
                            @foreach ($item->Preguntas_Valoracion as $question )
                                    <tr class="pregunta">
                                        <td colspan="1" style="width: 80%;">{{$question->pregunta}}:</td>

                                        @for ($i = 1; $i < 6; ++$i)
                                            @if ($solicitud->Curso_Rezago->Formulario_Valoracion_Academica()->where('pregunta_Id', $question->id)->first()->respuesta == $i)
                                                <td colspan="1" style="width: 4%;" class="center">X</td>
                                            @else
                                                <td colspan="1" style="width: 4%;" class="center"></td>
                                            @endif
                                        @endfor
                                    </tr>
                            @endforeach
                    @endforeach
                </table>
            </section>
        </main>

        <main>
            <h1 style="font-weight: 700; margin: 15px 0 15px 0; font-size: 18px;">Parte 2. Complete la información solicitada de forma extendida.</h1>
            <section class="contenedores">
                <h4 style="text-transform: none;";>4- ¿Considera que su salud fisica y/o emocional, le ha perjudicado y por eso ha perdido el curso? {{$solicitud->salud_Como_Impedimento ? 'Si(X) No( )' : "Si( ) No(X)"}} ¿Por qué?</h4>
                <p class="border"> {{$solicitud->salud_Como_Impedimento ? $solicitud->Salud_Fisica_Emocional->descipcion : 'No aplica'}} </p>
            </section>

            <section class="contenedores">
                <h4 style="text-transform: none;">5- ¿Considera que algún aspecto relacionado con su actitud hacia el curso: (como el interés por la materia, la prioridad que le ha dado al estudio o motivación, etc); podría estar influyendo para la aprobación del curso? {{$solicitud->actitud_Estudiante ? 'Si(X) No( )' : "Si( ) No(X)"}} ¿Por qué?</h4>
                <p class="border">{{$solicitud->actitud_Estudiante ? $solicitud->Actitud_Estudiante->descripcion : 'No aplica'}}</p>
            </section>
        </main>

        <main>
            <section class="contenedores">
                <h4>6- Resuma los motivos por lo cuales usted cree que no ha aprobado el curso:</h4>
                <p class="border">{{$solicitud->Curso_Rezago->resumen_No_Aprobar_El_Curso}}</p>
            </section>

            <section class="contenedores">
                <h4>7- ¿Qué espera al acogerse al PLAN DE ACCIÓN INDIVIDUAL?</h4>
                <p class="border">{{$solicitud->que_Espera_Del_Plan}}</p>
            </section>

            <section class="contenedores">
                <h4>8- Observaciones o comentarios del/de la docente u otros miebmbros del equipo, presentes en la reunión.</h4>
                <p class="border">{{$solicitud->comentarios_Presentes_Reunion}}
                </p>
            </section>
        </main>
            
            
        </body>
        </html>