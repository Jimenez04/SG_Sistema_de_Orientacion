<!DOCTYPE html>
<html>
<head>
 <title>Cuanta creada con éxito</title>
</head>
<body>

 <h1 class="titulo">Oficina de orientación, UCR, Sede Guanacaste</h1>

 <p style="font-family:arial; 
 font-weight: 500;
text-indent: 0.5rem; color:black; font-size:0.8rem; line-height: 1.5rem; ">{{$mensaje}}</p>

<div style="
border: #2B6797 2px;
border-style: solid;
width: 60%;
margin: 0 auto;
padding:2rem;
" 
class="datospersonales ">
    <h1 style="margin-bottom: 1rem " class="titulo titulo_info_personal">Detalles</h1>
        <div>
                <h2 class="subtitulo">Número solicitud: <span>{{$solicitud->numero_solicitud}}</span></h2>
                <h2 class="subtitulo">Carnet estudiante: <span>{{$solicitud->estudiante_carnet}}</span></h2>
                <h2 class="subtitulo">Razón de la solicitud: <span>{{$solicitud->razon_Solicitud}}</span></h2>
                <h2 class="subtitulo">Fecha: <span>{{$solicitud->created_at}}</span></h2>
                <h2 class="subtitulo">Estado de solicitud: <span>{{$solicitud->Revision_Solicitud->estado}}</span></h2>
<br>
                <h3 class="sub-subtitulo titulo">Trabajo</span></h3>
                @if ($solicitud->Estudiante->Persona->Trabajo !=null)
                    <h2 class="subtitulo">Actividad que desempeña: <span>{{$solicitud->Estudiante->Persona->Trabajo->actividad_Que_Desempena}}</span></h2>
                    <h2 class="subtitulo">Lugar de trabajo: <span>{{$solicitud->Estudiante->Persona->Trabajo->lugar_De_Trabajo}}</span></h2>
                    <h2 class="subtitulo">Horario Laboral: <span>{{$solicitud->Estudiante->Persona->Trabajo->horario_Laboral}}</span></h2>
                @else
                    <h2 class="subtitulo"><span>No específica</span></h2>
                @endif
<br>
                <h3 class="sub-subtitulo titulo">Datos académicos</span></h3>
                <h2 class="subtitulo">Nombre: <span>{{$solicitud->Institucion_Procedencia->nombre}}</span></h2>

                    <?php 
                            use Carbon\Carbon;   
                    ?>
                <h2 class="subtitulo">Año egreso: <span> {{ Carbon::parse($solicitud->Institucion_Procedencia->ano_egreso)->format('m-Y');  }} </span></h2>
                <h2 class="subtitulo">Año de Ingreso universidad: <span> {{ Carbon::parse($solicitud->Institucion_Procedencia->ano_ingreso_universidad)->format('m-Y');  }} </span></h2>

                <h2 class="subtitulo">Carrera Empadronada: <span>{{$solicitud->carrera_Empadronada}}</span></h2>
                <h2 class="subtitulo">¿Realizó traslado de carrera?: <span>{{$solicitud->realizo_Traslado_Carrera ? "Si":"No"}}</span></h2>
<br>
                <h3 class="sub-subtitulo titulo">Información sobre beca</span></h3>
                    @if ($solicitud->Estudiante->Beca !=null)
                        <h2 class="subtitulo">Tiene de beca: <span>Si</span></h2>
                        <h2 class="subtitulo">Categoría de beca: <span>{{$solicitud->Estudiante->Beca->categoria_Beca}}</span></h2>
                        <h2 class="subtitulo">Asistencia socioeconómica: <span>{{$solicitud->Estudiante->Beca->asistencia_Socioeconomica ? '(X)' : '( )'}}</span></h2>
                        <h2 class="subtitulo">Participación: <span>{{$solicitud->Estudiante->Beca->participacion ? '(X)' : '( )'}}</span></h2>
                    @else
                        <h2 class="subtitulo">Tiene beca: <span>No específica</span></h2>
                    @endif
<br>
                @if ($solicitud->Necesidad_Y_Apoyo !=null)
                    <h3 class="sub-subtitulo titulo">Información sobre necesidades educativas y apoyos requeridos</span></h3>
                    <h2 class="subtitulo">Diagnóstico: <span>{{$solicitud->Necesidad_Y_Apoyo->diagnostico}}</span></h2>
                    
                    <h2 class="subtitulo">Área, profesional que diagnostica: <span>{{$solicitud->Necesidad_Y_Apoyo->area_Profesional}}</span></h2> 
                    
                    <h2 class="subtitulo">¿Recibe atención y seguimiento por parte de algún especialista?: <span>{{$solicitud->Necesidad_Y_Apoyo->recibe_atencionyseguimiento ? "Si": "No aplica"}}</span></h2>
                    
                    <h2 class="subtitulo">Tipo de atención o seguimiento: <span>{{$solicitud->Necesidad_Y_Apoyo->atencionyseguimiento!= null ? $solicitud->Necesidad_Y_Apoyo->atencionyseguimiento: "No aplica"}}</span></h2>
                @else
                    <h3 class="sub-subtitulo titulo">Información sobre necesidades educativas y apoyos requeridos</span></h3>
                    <h2 class="subtitulo"> <span>No específica</span></h2>
                @endif
<br>
                <h3 class="sub-subtitulo titulo">Condición de salud actual</span></h3>
                    @if ($solicitud->saludActual != null)
                            <div class="container-items">
                                <div class="items">
                                    <h2 class="subtitulo">¿Padece de alguna enfermedad que le afecta su desempeño?: <span>{{$solicitud->saludActual->afectacionDesempeno ? 'Si':'No'}}</span></h2>
                                    <h2 class="subtitulo">¿Cuál?: <span>{{$solicitud->saludActual->enfermedad}}</span></h2>
                                    <h2 class="subtitulo">Tratamiento médico utilizado: <span>{{$solicitud->saludActual->tratamiento}}</span></h2>
                                </div>
                            </div>        
                    @else
                        <h2 class="subtitulo"><span>No específica</span></h2>
                    @endif
<br>
            <h3 class="sub-subtitulo titulo">Grupo Familiar</span></h3>
            @if ($solicitud->Grupo_Familiar != null)
                <h2 class="subtitulo">Discapacidades grupo familiar: <span>{{$solicitud->Grupo_Familiar->descripcion_De_Discapacidades}}</span></h2>
                        @foreach ( $solicitud->Grupo_Familiar->Pariente as $pariente)
                            <div class="container-items">
                                <div class="items">
                                    <h2 class="subtitulo">Tipo pariente: <span>{{$pariente->tipo_Pariente}}</span></h2>
                                    <h2 class="subtitulo">Cédula  pariente: <span>{{$pariente->persona_cedula}}</span></h2>
                                    <h2 class="subtitulo">Ocupación: <span>{{$pariente->ocupacion}}</span></h2>
                                </div>
                            </div>        
                        @endforeach
                    @else
                        <h2 class="subtitulo">Estado: <span>No específica</span></h2>
                    @endif
        </div>
</div>

 <span style="font-family:arial; color:black; font-size:0.5rem;">Este mensaje es autogenerado, favor no contestar este mensaje.</span>

</body>
<style>
    .container-items{
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        width: 100%;
        border: #2B6797 2px;
        border-style: solid;
        padding: 0.5rem 0rem;
        margin: 0 0 0.5rem 0;
    }
    .items{
        width: 90%;
        margin: 0 auto;
    }
    .container-items .items h2{
        width: fit-content;
    }
    .titulo{
        font-size:1rem; color:black; font-family:arial; font-weight:bold;
    }
    .titulo_info_personal{
        border: #2B6797 2px;
        border-bottom-style: solid;
        width: max-content;
        margin: 0 auto;
        margin-bottom: 0.6rem;
        padding: 0 0.2rem 0rem 0.2rem;
    }
    .subtitulo{
        font-size:.9rem; color:black; font-family:arial; font-weight:600;
        margin-bottom: 0.6rem;
    }
    .sub-subtitulo{
        border: #2B6797 2px;
        border-bottom-style: solid;
        margin: 1rem 0rem 0.5rem 0;
    }
    span{
        font-size:.9rem; color:black; font-family:arial; font-weight:400;
    }
</style>
</html> 