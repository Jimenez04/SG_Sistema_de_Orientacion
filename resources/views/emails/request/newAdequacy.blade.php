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
            <h2 class="subtitulo">Carrera Empadronada: <span>{{$solicitud->carrera_Empadronada}}</span></h2>
            <h2 class="subtitulo">Carreras simultáneas: <span>{{$solicitud->carreras_simultaneas ? "Si":"No"}}</span></h2>
            <h2 class="subtitulo">Realizó traslado de carrera: <span>{{$solicitud->realizo_Traslado_Carrera ? "Si":"No"}}</span></h2>
            <h2 class="subtitulo">Descripción: <span>{{$solicitud->descripcion}}</span></h2>
            <h2 class="subtitulo">Fecha: <span>{{$solicitud->created_at}}</span></h2>
            <h2 class="subtitulo">Estado de solicitud: <span>{{$solicitud->Revision_Solicitud->estado}}</span></h2>

            <h3 class="sub-subtitulo titulo">Institución De Procedencia</span></h3>
            <h2 class="subtitulo">Nombre: <span>{{$solicitud->Institucion_Procedencia->nombre}}</span></h2>
            <h2 class="subtitulo">Año egreso: <span>{{$solicitud->Institucion_Procedencia->ano_egreso}}</span></h2>

            @if ($solicitud->Necesidad_Y_Apoyo !=null)
                <h3 class="sub-subtitulo titulo">Necesidadades Educativas & Apoyo Requerido</span></h3>
                <h2 class="subtitulo">Diagnóstico: <span>{{$solicitud->Necesidad_Y_Apoyo->diagnostico}}</span></h2>
                <h2 class="subtitulo">Descripción se seguimiento: <span>{{$solicitud->Necesidad_Y_Apoyo->descripcion_Seguimiento != null ? $solicitud->Necesidad_Y_Apoyo->descripcion_Seguimiento: "No aplica"}}</span></h2>
                <h2 class="subtitulo">Descripción se atención: <span>{{$solicitud->Necesidad_Y_Apoyo->descripcion_Atencion!= null ? $solicitud->Necesidad_Y_Apoyo->descripcion_Atencion: "No aplica"}}</span></h2>
                <h2 class="subtitulo">Profesional que diagnóstica: <span>{{$solicitud->Necesidad_Y_Apoyo->profesional_Que_Diagnostica}}</span></h2>
                <h2 class="subtitulo">Área de atención: <span>{{$solicitud->Necesidad_Y_Apoyo->area_Profesional}}</span></h2> 
            @else
                <h2 class="subtitulo">Estado: <span>No posee</span></h2>
            @endif

            <h3 class="sub-subtitulo titulo">Enfermedades</span></h3>
                @if ($solicitud->Estudiante->Persona->Enfermedad != null)
                    @foreach ( $solicitud->Estudiante->Persona->Enfermedad as $enfermedad)
                        <div class="container-items">
                            <div class="items">
                                <h2 class="subtitulo">Tipo Enfermedad: <span>{{$enfermedad->tipo_Enfermedad}}</span></h2>
                                <h2 class="subtitulo">Descripción: <span>{{$enfermedad->descripcion}}</span></h2>
                                <h2 class="subtitulo">Tratamiento: <span>{{$enfermedad->tratamiento}}</span></h2>
                                <h2 class="subtitulo">Rutina de tratamiento: <span>{{$enfermedad->rutina_Tratamiento}}</span></h2>
                            </div>
                        </div>        
                    @endforeach
                @else
                    <h2 class="subtitulo">Estado: <span>No posee</span></h2>
                @endif
           
            @if ($solicitud->Estudiante->Persona->Trabajo !=null)
                <h3 class="sub-subtitulo titulo">Trabajo</span></h3>
                <h2 class="subtitulo">Trabajo actual: <span>{{$solicitud->Estudiante->Persona->Trabajo->trabajo_Actual}}</span></h2>
                <h2 class="subtitulo">Actividad: <span>{{$solicitud->Estudiante->Persona->Trabajo->actividad_Que_Desempena}}</span></h2>
                <h2 class="subtitulo">Lugar de trabajo: <span>{{$solicitud->Estudiante->Persona->Trabajo->lugar_De_Trabajo}}</span></h2>
                <h2 class="subtitulo">Jornada: <span>{{$solicitud->Estudiante->Persona->Trabajo->jornada_Trabajo}}</span></h2>
                <h2 class="subtitulo">Horario laboral: <span>{{$solicitud->Estudiante->Persona->Trabajo->horario_Laboral}}</span></h2>
            @else
                <h2 class="subtitulo">Estado: <span>No posee</span></h2>
            @endif

        @if ($solicitud->Estudiante->Beca !=null)
            <h3 class="sub-subtitulo titulo">Beca</span></h3>
            <h2 class="subtitulo">Categoría de beca: <span>{{$solicitud->Estudiante->Beca->categoria_Beca}}</span></h2>
            <h2 class="subtitulo">Ayuda socioeconómica: <span>{{$solicitud->Estudiante->Beca->asistencia_Socioeconomica}}</span></h2>
            <h2 class="subtitulo">Participación: <span>{{$solicitud->Estudiante->Beca->participacion}}</span></h2>
        @else
            <h2 class="subtitulo">Estado: <span>No posee</span></h2>
        @endif

        <h3 class="sub-subtitulo titulo">Grupo Familiar</span></h3>
        @if ($solicitud->Grupo_Familiar != null)
            <h2 class="subtitulo">Discapacidades grupo familiar: <span>{{$solicitud->Grupo_Familiar->descripcion_De_Discapacidades}}</span></h2>
                    @foreach ( $solicitud->Grupo_Familiar->Pariente as $pariente)
                        <div class="container-items">
                            <div class="items">
                                <h2 class="subtitulo">Tipo pariente: <span>{{$pariente->tipo_Pariente}}</span></h2>
                                <h2 class="subtitulo">Cédula  pariente: <span>{{$pariente->persona_cedula}}</span></h2>
                                <h2 class="subtitulo">Discapacidad de pariente: <span>{{$pariente->discapacidad_Si_Presenta}}</span></h2>
                            </div>
                        </div>        
                    @endforeach
                @else
                    <h2 class="subtitulo">Estado: <span>No posee</span></h2>
                @endif
        </div>
</div>

<p 
style="
font-family:arial; 
font-weight: 500;
text-indent: 0.5rem;
color:black;
font-size:0.8rem;
line-height: 1.5rem;
margin-top: 1rem;
 "
>
    {{-- {{$mensaje2}} --}}
</p>

 
 
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
        border-bottom: 2px solid #2B6797;
        margin-bottom: 0.6rem;
    }
    .sub-subtitulo{
        border: #2B6797 2px;
        border-bottom-style: solid;
        width: max-content;
        margin: 1rem 0rem 0.5rem 0;
    }
    span{
        font-size:.9rem; color:black; font-family:arial; font-weight:400;
    }
</style>
</html> 