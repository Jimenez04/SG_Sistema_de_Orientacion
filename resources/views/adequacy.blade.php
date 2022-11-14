<?php
use Carbon\Carbon;    
use App\Models\SolicitudDeAdecuacion;
use App\Models\Persona;
$imgPath = public_path('storage\img\firma-horizontal-dos-lineas-cmky.jpg');
$img = base64_encode(file_get_contents($imgPath));

$solicitud = SolicitudDeAdecuacion::all()->first();
?>
<html>
    <head>
        <style>
            @page {
                position: relative;
                max-width: 100%;
                
            }
            body{
                margin: 100px 50px 20px 50px;
            }
            section{
                margin-top: 25px;
            }
            h1,h2,h3,p, span{
                /* text-align: justify; */
                /* text-justify: inter-word; */
                font-weight: normal;
                line-height : 20px;
            }
            h1{
                font-size: 14px;
                font-weight: bold;
            }
            h1.main-title{
                text-align: center;
                width: 100%;
            }
            h2{
                font-size: 12px;
            }
            span{
                font-size: 12px;
            }
            h3{
                font-size: 12px;
                font-weight: 400;
                /* line-height : 5px; */
            }
            p{
                font-size: 12px;
                white-space: pre-line;
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

             /* Para uso exclusivo de la Unidad de Vida Estudiantil */
             .border{
                border: black 1px;
                border-style: solid;
             }
             #vidaestudiantil{
                padding-bottom: 20px;
                margin-top: 50px;
             }
             #vidaestudiantil h1{
                width: 100%;
                text-align: center;
             }
             #vidaestudiantil .menu-float{
                margin-bottom: 25px;
             }
             #vidaestudiantil .menu-float,
             #vidaestudiantil .menu-area-especialista{
                margin: 0 30px;
             }
             #vidaestudiantil .menu-float h3{
                display: inline;
                text-align: start;
                margin: 0;
             }
             #vidaestudiantil .menu-float h3:last-of-type{
                float: right;
                margin-right: 10px;
             }
             #vidaestudiantil .menu-area-especialista h3:not(:last-child){
                margin: 15px 0 6px 0;
             }
             #vidaestudiantil .menu-area-especialista h3:last-child{
                margin: 0;
             }
             /* End Para uso exclusivo de la Unidad de Vida Estudiantil */

             /* datos-personales */
             .contenedor-h1-tabla > h1,
             #datos-personales > h2{
                margin:0;
                border-bottom: 0;
                width: fit-content;
                display: inline-block;
                padding: 0 30px;
             }
             #datos-personales > h2{
                float: right;
                padding: 0 15px 0 3px;
            }
            
            .contenedor-h1-tabla section{
                padding: 0px;
                margin: 0 !important;
            }
            table{
                width:100%;
            }
            #datos-personales h2,
            #datos-grupo-familiar h2{
                text-align: center !important;
                font-weight: bold;
                margin: 0;
                display: block
            }
            #datos-personales .tabla-datos-personales .fila-trabaja h2,
            .contenedor-h1-tabla  h2{
                text-align: initial !important;
                padding-left: 10px;
                display: inline-block;
                font-weight: bold;
                margin: 0;
            }
            #datos-academicos  h3,
            #datos-necesidades h3,
            #datos-salud h3{
                display: inline-block;
            }
            #datos-necesidades h3,
            #datos-salud h3{
                text-align: initial;
            }

            table h3{
                text-align: center;
                margin: 0;
                display: block;
                vertical-align: middle;
                width: auto;
                margin: auto 0;
                line-height: 20px;
                padding: 0 8px 0 8px;
            }
            #datos-personales .tabla-datos-personales .fila-trabaja h3,
            #datos-academicos .fila-uno h3,
            #datos-academicos .texto-inicial h3{
                display: inline-block;
                width: 100px;
            }
            #datos-beca h3{
                display: inline-block;
            }
            table{
                border-collapse: collapse;
            }
            table td{
                height: 30px;
            }
            table .fila-uno{
                border-top: 0 !important;
                border-bottom: .5px solid black !important;
                border-left: 0 !important;
                border-right: 0 !important;
            }
            table tr:last-of-type td{
                border-bottom: 0;
            }
            table tr:first-of-type td{
                border-top: 0;
            }
            table tr td:last-of-type{
                border-right: 0 !important;
                border-bottom: 0;
            }
            table tr td:first-of-type{
                border-left: 0 !important;
                border-bottom: 0;
            }
            table td, table th {
            border: .5px solid black;
            vertical-align: middle;
            }
            #datos-personales .tabla-datos-personales .fila-trabaja td{
                height: 30px !important;
            }
             #datos-personales .tabla-datos-personales .fila-trabaja div{
                display: inline-block;
                padding: 10px;
                margin-bottom: -16px;
            }
            
            #final-section section:first-of-type{
                margin-bottom: 0;
                border-bottom: 0;
                margin-top: 15px;
            }
            #final-section section:last-of-type{
                margin-top: 0;
            }
            .container-final{
                min-height: 350px;
            }
            .container-final h2{
                padding: 0 8px 0 8px;
                font-weight: bold;
                margin: 0;
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

        <footer class="container-footer-header" style={}>
            <hr>
            <div class="flex footer-container" style="display:block; ">
                <div style="width:50%; display:inline-block">
                    <Label>Teléfono: </Label> <label style="font-size: 12px;">2511-9576</label>
                </div>
                <div style="width:50%;   display:inline; text-align:end">
                    <Label>Correo electrónico: </Label><label style="font-size: 12px;">orientacion.sg@ucr.ac.cr</label>
                </div>
            </div>
        </footer>

        <main>
            <section class="section-header-text" style="width:100%;">
                <div class="div-main-title" style="width:100%;">
                    <h1 class="main-title">SOLICITUD DE ADSCRIPCIÓN AL ARTÍCULO 37</h1>
                </div>
                <div>
                    <h3>Señores</h3>
                    <h3>Unidad de Vida Estudiantil</h3>
                    <h3>Sede de Guanacaste</h3>
                    <h3>Universidad de Costa Rica</h3>
                </div>
            </section>

            <section>
                <p>Yo {{$solicitud->Estudiante->Persona->nombre1 }} {{$solicitud->Estudiante->Persona->nombre2 }} {{$solicitud->Estudiante->Persona->apellido1 }} {{$solicitud->Estudiante->Persona->apellido2 }}, carné: {{$solicitud->Estudiante->carnet }}, por este medio presento mi solicitud de adscripción al Artículo 37, del reglamento de Regimen Académico Estudiantil para la aplicación de adecuaciones en la universidad.
                Adjunto para este proceso la siguiente documentación:</p>
                <p style="text-indent: 40px;">- Diagnóstico o valoración.</p>
                <p style="text-indent: 40px;">- Dictamen médico.</p>
                <p>En caso de no adjuntar lo mencionado anteriormente, estoy plenamente consciente que mi solicitud puede ser rechazada de inmediato.</p>
            </section>

            <section>
                <h1>IMPORTANTE</h1>
                <p>Según lo establecido en el reglamento de Régimen Académico Estudiantil las adecuaciones que se le aprueben para su aplicación en los diferentes cursos serán definidas en forma conjunta y definitiva en la reunión de Equipo de Apoyo convocada por la Dirección de la Unidad Académica de empadronamiento, en el transcurso de las primeras semanas de cada ciclo lectivo.
                Usted deberá pasar a retirar la copia del oficio enviado y recibido por su unidad Académica durante la primera semana de clases, que le servirá como comprobante de su gestión.
                </p>
            </section>

            <section id="vidaestudiantil" class="border">
                <div>
                    <h1>Para uso exclusivo de la Unidad de Vida Estudiantil</h1>
                    {{ $solicitud->Revision_Solicitud->estado == "Aprobada"}}
    
                    @if ($solicitud->Revision_Solicitud->estado == "Aprobada")
                    <div>
                        <div class="menu-float">
                            <h3>Solicitud aprobada (X)</h3>
                            <h3>Fecha: {{ $solicitud->Revision_Solicitud->fecha }}</h3>
                        </div>
                         <div class="menu-area-especialista">
                            <h3>Área: _________________</h3>
                            <h3>Especialista: _________________</h3>
                        </div>
                    </div>
                    @else
                        <div >
                            <div class="menu-float">
                                <h3>Solicitud aprobada ( )</h3>
                                <h3>Fecha: _____________</h3>
                            </div>
                             <div class="menu-area-especialista">
                                <h3>Área: _________________</h3>
                                <h3>Especialista: _________________</h3>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        </main>

        <main>
            <section id="datos-personales" class=" contenedor-h1-tabla">
                <h1 class="border">1. Datos personales</h1>
                <h2 class="border">Carné: <span>{{$solicitud->Estudiante->carnet }}</span></h2>
                <div class="border">
                    <section class="datos-personales">
                        <table class="tabla-datos-personales">
                            <tr>
                                <td class="fila-uno">
                                   <h2>Primer Apellido</h2>  
                                </td>
                                 <td class="fila-uno">
                                   <h2>Segundo Apellido </h2>
                                </td>
                                <td class="fila-uno">
                                   <h2>Nombre</h2>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h3>{{$solicitud->Estudiante->Persona->apellido1 }}</h3> 
                                </td>
                                 <td>
                                    <h3>{{$solicitud->Estudiante->Persona->apellido2 }}</h3> 
                                </td>
                                <td>
                                    <h3>{{$solicitud->Estudiante->Persona->nombre1}}  {{$solicitud->Estudiante->Persona->nombre2 }}</h3> 
                                </td>
                            </tr>
                            <tr>
                                <td><h2>Identificación</h2></td>
                                <td><h2>Fecha de nacimiento</h2></td>
                                <td><h2>Edad</h2></td>
                            </tr>
                            <tr>
                                <td><h3>{{$solicitud->Estudiante->Persona->cedula }}</h3></td>
                                <td><h3>{{$solicitud->Estudiante->Persona->fecha_Nacimiento }}</h3></td>
                                <td><h3>{{ $edad = Carbon::parse($solicitud->Estudiante->Persona->fecha_Nacimiento)->age;  }}</h3></td>
                            </tr>
                            <tr>
                                <td><h2>Contactos</h2></td>
                                <td colspan="2"><h2>Correo</h2></td>
                            </tr>
                            <tr>
                                <?php 
                                    $numeros = "";
                                        foreach ($solicitud->Estudiante->Persona->Contacto as $contacto) {
                                            $numeros .=  $contacto->numero . ", "; 
                                        }
                                ?>
                                <td><h3>{{$numeros}}</td>
                                <?php 
                                    $correos = "";
                                        foreach ($solicitud->Estudiante->Persona->Email as $email) {
                                            $correos .= $email->email . ", ";  
                                        }
                                ?>
                                <td colspan="2"><h3>{{$correos}}</td>
                            </tr>
                            <tr class="fila-trabaja">
                                <td colspan="3">
                                    <h2>Trabaja:</h2>
                                    <div>
                                        @if ($solicitud->Estudiante->Persona->Trabajo != null)
                                        <h3 class="border">Si (X)</h3>
                                        <h3 class="border">No</h3>
                                        @else
                                        <h3 class="border">Si</h3>
                                        <h3 class="border">No (X)</h3>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr class="fila-trabaja">
                                <td colspan="3"><h2>Actividad que desempeña:</h2>
                                    <h3 style="text-align: initial; width:auto">{{$solicitud->Estudiante->Persona->Trabajo != null ? $solicitud->Estudiante->Persona->Trabajo->actividad_Que_Desempena : "No aplica" }} </h3>
                                </td>
                                
                            </tr>
                            <tr class="fila-trabaja">
                                <td colspan="3"><h2>Lugar de trabajo: </h2>
                                    <h3 style="text-align: initial; width:auto">{{$solicitud->Estudiante->Persona->Trabajo!= null ?$solicitud->Estudiante->Persona->Trabajo->lugar_De_Trabajo : "No aplica" }}</h3>
                                </td>
                            </tr>
                            <tr class="fila-trabaja">
                                <td colspan="3"><h2>Horario Laboral: </h2> <h3 style="text-align: initial; width:auto">{{$solicitud->Estudiante->Persona->Trabajo != null ?$solicitud->Estudiante->Persona->Trabajo->horario_Laboral : "No aplica" }}</h3></td>
                            </tr>
                        </table>
                    </section>
                </div>
            </section>
            <section id="datos-academicos" class=" contenedor-h1-tabla">
                <h1 class="border">2. Datos académicos</h1>
                <div class="border">
                    <section>
                        <table>
                            <tr>
                                <td class="texto-inicial fila-uno" colspan="3" >
                                   <h2>Institución o sistema educatico de procedencia:</h2>  <h3 style="width: auto; text-align:initial;">{{$solicitud->Institucion_Procedencia->nombre }}</h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1" style="width:50%;">
                                    <h2>Año egreso: </h2>
                                    <h3>{{Carbon::parse($solicitud->Institucion_Procedencia->ano_ingreso_universidad)->format('m-Y');}}</h3> 
                                </td>
                                 <td colspan="2" style="width:50%;">
                                    <h2>Año de ingreso a la universidad: </h2>
                                    <h3>{{Carbon::parse($solicitud->Institucion_Procedencia->ano_egreso)->format('m-Y'); }}</h3> 
                                </td>
                            </tr>
                            <tr>
                                <td class="texto-inicial" colspan="3">
                                    <h2>Carrera en la que se encuentra empadronad/a:</h2> <h3 style="width: auto;">{{$solicitud->carrera_Empadronada}}  </h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1" style="width:50%;"><h2>Año de ingreso a la carrera:</h2> <h3>{{Carbon::parse($solicitud->ano_ingreso_carrera)->format('m-Y');}}</h3></td>

                                <td colspan="1" style="width:50%;"><h2>Nivel de carrera: </h2>  <h3>{{$solicitud->nivel_carrera;}}%</h3></td>
                            </tr>
                            <tr>
                                <td colspan="3"><h2>Si lleva dos carreras a la vez, nombre la segunda:</h2> <h3>{{$solicitud->nombre_segunda_carrera != null ? $solicitud->nombre_segunda_carrera : "No aplica" }}</h3></td>
                            </tr>
                            <tr>
                                <td colspan="3"><h2>Si realizo traslado de carrera:</h2>    <h3>{{$solicitud->realizo_Traslado_Carrera ? "Si(X) NO( )":"Si( ) No(X)"}}</h3></td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <h2>Nombre la carrera en la que estuvo empadronad/a:</h2>   <h3>
                                        {{$solicitud->carrera_empadronado_anterior != null ? $solicitud->carrera_empadronado_anterior : "No aplica" }}
                                    </h3>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"><h2 style="margin-bottom: 0px;">Situación académica actual relacionada con el desempeño académico y dificultades presentadas.</h2>  <h3 style="padding-left: 10px">{{$solicitud->razon_Solicitud}}</h3></td>
                            </tr>
                        </table>
                    </section>
                </div>
            </section>
        </main>
        <main>
            <section id="datos-beca" class="contenedor-h1-tabla">
                <h1 class="border" >3. Información sobre Beca</h1>
                <div class="border">
                    <section>
                        <table>
                            @if ($solicitud->Estudiante->Beca !=null)
                                <tr>
                                    <td class="texto-inicial fila-uno" colspan="3" >
                                    <h2>Tiene beca: <h3 style="width: auto; text-align:initial;">Si(X) No( )</h3></h2>  
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="width:50%;">
                                        <h2>Asistencia Socioeconómica </h2>
                                        <h3>{{$solicitud->Estudiante->Beca->asistencia_Socioeconomica ? "(X)" : "( )"}}</h3> 
                                    </td>
                                    <td colspan="2" style="width:50%;">
                                        <h2>Participación </h2>
                                        <h3>{{$solicitud->Estudiante->Beca->participacion ? "(X)" : "( )"}}</h3> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h2>Categoría  <h3>{{$solicitud->Estudiante->Beca->categoria_Beca}}</h3></h2>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td class="texto-inicial fila-uno" colspan="3" >
                                    <h2>Tiene beca: </h2>   <h3 style="width: auto; text-align:initial;">Si( ) No(X)</h3>  
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="width:50%;">
                                        <h2>Asistencia Socioeconómica </h2> <h3> ( )</h3> 
                                    </td>
                                    <td colspan="2" style="width:50%;">
                                        <h2>Participación </h2>  <h3> ( ) </h3> 
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <h2>Categoría: </h2>  <h3>( )</h3>
                                    </td>
                                </tr>
                                @endif
                        </table>
                    </section>
                </div>
            </section>

            <section id="datos-grupo-familiar" class="contenedor-h1-tabla">
                <h1 class="border" >4. Información del grupo familiar</h1>
                <div class="border">
                    <section>
                        <table>
                                <tr style="    background-color: darkgray;">
                                    <td class="texto-inicial fila-uno" >
                                    <h2>Nombre</h2>  
                                    </td>
                                    <td >
                                        <h2>Parentesco</h2>
                                    </td>
                                    <td>
                                        <h2>Edad</h2>
                                    </td>
                                    <td>
                                        <h2>Ocupación</h2>
                                    </td>
                                </tr>
                                @foreach ($solicitud->Grupo_Familiar->Pariente as $pariente )
                                <?php $persona = Persona::find($pariente->persona_cedula); 
                                ?>
                                    <tr>
                                        <td><h3>{{$persona->nombre1}}</h3></td>
                                        <td><h3>{{$pariente->tipo_Pariente}}</h3></td>
                                        <td><h3>{{Carbon::parse($persona->fecha_Nacimiento)->age;}}</h3></td>
                                        <td><h3>{{$pariente->ocupacion}}</h3></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">
                                        <h2>Presencia en el grupo familiar de alguna condición de discapacidad, emocional, de salud y/o necesidad educativa</h2>
                                        <p style="padding-left: 8px">{{$solicitud->Grupo_Familiar->descripcion_De_Discapacidades}}</p>
                                    </td>
                                </tr>
                        </table>
                    </section>
                </div>
            </section>
        </main>
        
       <main>
            <section id="datos-necesidades" class="contenedor-h1-tabla">
                <h1 class="border" >5. Información sobre necesidades educativas y apoyos requeridos</h1>
                <div class="border">
                    <section>
                        <table>
                                <tr>
                                    <td class="texto-inicial fila-uno"  >
                                        <h2>Diagnóstico: </h2> 
                                        <h3>{{$solicitud->Necesidad_Y_Apoyo->diagnostico}}</h3> 
                                    </td>
                                </tr>
                            <tr>
                                    <td>
                                        <h2>Área de especialización del profesional que diagnóstica: </h2>
                                        <h3>{{$solicitud->Necesidad_Y_Apoyo->area_Profesional != null ? $solicitud->Necesidad_Y_Apoyo->area_Profesional : "No índica" }}</h3>
                                    </td>
                            </tr>
                            <tr>
                                    <td>
                                        <h2>¿Recibe atención y seguimiento por parte de algún especialista?</h2>
                                        <h3>{{$solicitud->Necesidad_Y_Apoyo->recibe_atencionyseguimiento ? "Si(X) No(  )": "Si(  ) No(X)"}}</h3>
                                    </td>
                            </tr>
                            <tr>
                                <td>
                                    <h2>Tipo: </h2>
                                    <h3>{{$solicitud->Necesidad_Y_Apoyo->atencionyseguimiento!= null ? $solicitud->Necesidad_Y_Apoyo->atencionyseguimiento: "No aplica"}}</h3>
                                </td>
                        </tr>
                        </table>
                    </section>
                </div>
            </section>

            <section id="datos-salud" class="contenedor-h1-tabla">
                <h1 class="border" >6. Condición de salud actual</h1>
                <div class="border">
                    <section>
                        <table>
                                <tr>
                                    <td class="texto-inicial fila-uno"  >
                                        <h2>¿Padece de alguna enfermedad que le afecta su desempeño?</h2> 
                                        <h3>{{$solicitud->saludActual->afectacionDesempeno ? 'Si':'No'}}</h3> 
                                    </td>
                                </tr>
                            <tr>
                                    <td>
                                        <h2>Cuál: </h2>
                                        <h3>{{$solicitud->saludActual->enfermedad != null ? $solicitud->saludActual->enfermedad : "No aplica" }}</h3>
                                    </td>
                            </tr>
                            <tr>
                                    <td>
                                        <h2>Tratamiento médico utilizado actualmente en forma rutinaria:</h2>
                                        <h3>{{$solicitud->saludActual->tratamiento != null ? $solicitud->saludActual->tratamiento : "No aplica" }}</h3>
                                    </td>
                            </tr>
                        </table>
                    </section>
                </div>
            </section>
       </main>

       <main id="final-section">
        <h1 style="margin-bottom: 0; text-align:center;">USO EXCLUSIVO PARA FUNCIONARIOS DE LA UNIVERSIDAD</h1>
        <section class="border container-final">
            <h2>Recomendaciones propuestas por parte de la especialista CASED:</h2>
            @if ($solicitud->Revision_Solicitud->Recomendaciones != null)
                @foreach ($solicitud->Revision_Solicitud->Recomendaciones as $recomendacion )
                <hr style="width: 80%; border-top: 1px dotted blue">
                    <h2 style="text-align: initial">Especialista: </h2><em>{{$recomendacion->nombre_Especialista}}</em>
                    <h2 style="text-align: initial">Recomendación: </h2><p style="    margin: 0;
                    padding-left: 8px;">{{$recomendacion->descripcion_Recomendacion}}</p>
                <hr style="width: 80%; border-top: 1px dotted blue">
                @endforeach
            @endif
        </section>

        <section class="border container-final">
            <h2>Observaciones:</h2>
            @if ($solicitud->Revision_Solicitud->Observacion != null)
                @foreach ($solicitud->Revision_Solicitud->Observacion as $observacion )
                <hr style="width: 80%; border-top: 1px dotted blue">
                    <h2 style="text-align: initial">Nombre: </h2><em>{{$observacion->nombre}}</em>
                    <h2 style="text-align: initial">Descripción: </h2><p style="    margin: 0;
                    padding-left: 8px;">{{$observacion->descripcion}}</p>
                <hr style="width: 80%; border-top: 1px dotted blue">
                @endforeach
            @endif
        </section>

       </main>

    </body>
</html>