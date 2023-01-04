<?php
use Carbon\Carbon;    
//use App\Models\Plan_De_Accion_Individual;
use App\Models\Persona;
$imgPath = public_path('storage/img/firma-horizontal-dos-lineas-cmky.jpg');
$img = base64_encode(file_get_contents($imgPath));

 //$solicitud = Plan_De_Accion_Individual::all()->first();
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
                margin: 0;
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
                margin: 0;
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
                margin: 0;
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
                <div style="width:50%;   display:inline; text-align:end; margin-top:-8px;">
                    <Label>Correo electrónico: </Label><label style="font-size: 12px;">orientacion.sg@ucr.ac.cr</label>
                </div>
            </div>
        </footer>

        <main>
            <section class="section-header-text" style="width:100%;">
                <div>
                    <h3>Fecha: {{Carbon::now()->format('d-m-Y')}} </h3>
                    <h3>MSc. Marta Bustamante Mora</h3>
                    <h3>Director</h3>
                    <h3>Sede Guanacaste</h3>
                </div>
            </section>

            <section>
                <div class="div-main-title" style="width:100%;">
                    <h1 class="main-title">SOLICITUD PARA ACOGERSE A UN PLAN DE AACIÓN INDIVIDUAL(PAI)</h1>
                    <h2 style="text-align: center">Artículo 36, Reglamento de Régimen Académico Estudiantil</h2>
                </div>
                    <?php
                    if(Carbon::now()->month >= 8 && Carbon::now()->month <=  12){
                        $ano = Carbon::now()->year + 1;
                     }else{
                        $ano = Carbon::now()->year;
                     }  
                   
                    ?>
                <h2>Estimado señor/a</h2>
                <p>Reciba un cordial saludo, a la vez y de acuerdo con lo establecido en el art. 36, 36 bis y 36 ter del Reglamento de Régimen Académico Estudiantil, solicito acogerme a un plan de acción individual para el curso {{$solicitud->Curso_Rezago->nombre_Curso}} para que se aplique en el {{$solicitud->semestre}} ciclo del {{$ano}}.
                El motivo por el cual solicito el PAl, es que he llevado el curso {{$solicitud->Curso_Rezago->numero_De_Matriculas}} veces en ciclos anteriores, por lo que me encuentro en condición de rezago.</p>
                <h2>Considero que las razones por las cuales no he podido aprobar el curso son:</h2>
                    <p>{{$solicitud->Curso_Rezago->resumen_No_Aprobar_El_Curso}}</p>

                <p>Le informo, que este ciclo matriculé el curso mencionado en el grupo {{$solicitud->Curso_Rezago->grupo}}, con el/la profesor/a {{$solicitud->Curso_Rezago->docente}}.</p>

            </section>

            <section id="estudiante" >
                <div>
                    <p>Agradeciendo su atención, le saluda,</p>
                    <br>
                    <div>
                        <h2>{{$solicitud->Estudiante->Persona->nombre1}}  {{$solicitud->Estudiante->Persona->nombre2 }} {{$solicitud->Estudiante->Persona->apellido1 }} {{$solicitud->Estudiante->Persona->apellido2 }} </h2>
                        <h2>Carné: {{$solicitud->Estudiante->carnet }} </h2>
                        <h2>Teléfono:  {{$solicitud->Estudiante->Persona->Contacto->first()  != null ?
                            $solicitud->Estudiante->Persona->Contacto->first()->numero : 
                            'No aplica' }}</h2>
                        <h2>Correo: {{$solicitud->Estudiante->Persona->User->email}}</h2>
                    </div>
    

                </div>
            </section>
            <br>
            <p style="font-weight: bold; padding:8px;" class="border">En caso de no adjuntar lo mencionado anteriormente, estoy plenamente consciente que mi solicitud puede ser rechazada de inmediato.</p>
        </main>
    </body>
</html>