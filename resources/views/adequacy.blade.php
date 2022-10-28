<?php

$imgPath = public_path('storage\img\firma-horizontal-dos-lineas-cmky.jpg');
$img = base64_encode(file_get_contents($imgPath));

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
            h1,h2,h3,p{
                /* text-align: justify; */
                /* text-justify: inter-word; */
                font-weight: normal;
                line-height : 15px;
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
            h3{
                font-size: 12px;
                font-weight: 400;
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
            .flex{
                display: flex;
            }
            .header-container{
                justify-content: flex-start; 
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
            <div class="flex footer-container" style="display:flex; ">
                <div style="max-width:50%; ">
                    <Label>Teléfono: <span>2511-9576</span></Label>
                </div>
                <div style="max-width:50%;">
                    <Label>Correo electrónico: <span>orientacion.sg@ucr.ac.cr</span></Label>
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
                </p>
                <p> Adjunto para este proceso la siguiente documentación:
                    - Diagnóstico o valoración.
                    - Dictamen médico.
                En caso de no adjuntar lo mencionado anteriormente, estoy plenamente consciente que mi solicitud puede ser rechazada de inmediato.
                </p>
            </section>

            <section>
                <h1>IMPORTANTE</h1>
                <p>Según lo establecido en el reglamento de Régimen Académico Estudiantil las adecuaciones que se le aprueben para su aplicación en los diferentes cursos serán definidas en forma conjunta y definitiva en la reunión de Equipo de Apoyo convocada por la Dirección de la Unidad Académica de empadronamiento, en el transcurso de las primeras semanas de cada ciclo lectivo.
                Usted deberá pasar a retirar la copia del oficio enviado y recibido por su unidad Académica durante la primera semana de clases, que le servirá como comprobante de su gestión.
                </p>
            </section>

            <section>
                <div>
                    <h1>Para uso exclusivo de la Unidad de Vida Estudiantil</h1>
                    {{ $solicitud->Revision_Solicitud->estado == "Aprobada"}}
    
                    @if ($solicitud->Revision_Solicitud->estado == "Aprobada")
                    <div>
                        <div>
                            <h3>Solicitud aprobada (X)</h3>
                            <h3>Fecha: {{ $solicitud->Revision_Solicitud->fecha }}</h3>
                        </div>
                         <div>
                            <h3>Área: _________________</h3>
                            <h3>Especialista: <span>{{$solicitud->Revision_Solicitud->Recomendaciones->nombreEspecialista}}</span></h3>
                        </div>
                    </div>
                    @else
                        <div>
                            <div>
                                <h3>Solicitud aprobada ( )</h3>
                                <h3>Fecha: _____________</h3>
                            </div>
                             <div>
                                <h3>Área: _________________</h3>
                                <h3>Especialista: _________________</h3>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        </main>

        <main>
            <section>
                <h1>Datos personales</h1>
                <section>
                    <div>
                        <h2>Carné: <span>{{$solicitud->Estudiante->carnet }}</span></h2>
                    </div>
        
                    <div>
                        <div>
                            <h2>Primer apellido: <span>{{$solicitud->Estudiante->Persona->apellido1 }}</span></h2>
                        </div>
                        <div>
                            <h2>Segundo apellido: <span>{{$solicitud->Estudiante->Persona->apellido2 }}</span></h2>
                        </div>
                    </div>
        
                    <div>
                        <div>
                            <h2>Nombre: <span>{{$solicitud->Estudiante->Persona->apellido1 }} . " " {{$solicitud->Estudiante->Persona->apellido2 }}</span></h2>
                        </div>
                    </div>

                    <div>
                        <div>
                            <h2>Identificación: <span>{{$solicitud->Estudiante->Persona->cedula }}</span></h2>
                        </div>
                        <div>
                            <h2>Fecha de nacimiento: <span>{{$solicitud->Estudiante->Persona->fecha_Nacimiento }}</span></h2>
                        </div>
                        <div>
                            <?php 
                            use Carbon\Carbon;    
                            ?>
                            <h2>Edad: <span>{{ $edad = Carbon::parse($solicitud->Estudiante->Persona->fecha_Nacimiento)->age;  }}</span></h2>
                        </div>
                    </div>

                    <div>
                        <div>
                            <?php 
                                $numeros = "";
                                     foreach ($solicitud->Estudiante->Persona->Contacto as $contacto) {
                                         $numeros .=  $contacto->numero . ", "; 
                                     }
                            ?>
                            <h2>Contactos: <span>{{$numeros}}</span></h2>
                        </div>
                        <div>
                            <?php 
                                $correos = "";
                                     foreach ($solicitud->Estudiante->Persona->Email as $email) {
                                         $correos .= $email->email . ", ";  
                                     }
                            ?>
                            <h2>Correo: <span>{{$correos}}</span></h2>
                        </div>
                    </div>

                    <div>
                        <h2>Trabaja</h2>
                        @if ($solicitud->Estudiante->Persona->Trabajo != null)
                            <div>
                                <div>
                                    <span>Si (X)</span>
                                    <span>No</span>
                                </div>
                            </div>
                            <div>
                                <h3>Actividad que desempeña: <span>{{$solicitud->Estudiante->Persona->Trabajo->actividad_Que_Desempena}}</span></h3>
                            </div>
                            <hr>
                            <div>
                                <h3>Lugar de trabajo: <span>{{$solicitud->Estudiante->Persona->Trabajo->lugar_De_Trabajo}}</span></h3>
                            </div>
                            <hr>
                            <div>
                                <h3>Horario Laboral: <span>{{$solicitud->Estudiante->Persona->Trabajo->horario_Laboral}}</span></h3>
                            </div>
                        @else
                            <div>
                                <div>
                                    <span>Si</span>
                                    <span>No (X)</span>
                                </div>
                            </div>
                        @endif
                    </div>

                </section>
            </section>
        </main>


        {{-- {{$solicitud}} --}}

    </body>
</html>