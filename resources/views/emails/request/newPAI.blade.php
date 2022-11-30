<?php 
//  use App\Models\Persona;
?>
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
                <h2 class="subtitulo">Número solicitud: <span>{{$solicitud->numero_Solicitud}}</span></h2>
                <h2 class="subtitulo">Carnet estudiante: <span>{{$solicitud->estudiante_Carnet}}</span></h2>
                <h2 class="subtitulo">Semestre: <span>{{$solicitud->semestre}}</span></h2>
                <h2 class="subtitulo">Nombre carrera: <span>{{$solicitud->nombre_Carrera}}</span></h2>
                <h2 class="subtitulo">Estado: <span>{{$solicitud->estado}}</span></h2>
<br>
                <h3 class="sub-subtitulo titulo">Curso</span></h3>
                    <h2 class="subtitulo">Nombre curso: <span>{{$solicitud->Curso_Rezago->nombre_Curso}}</span></h2>
                    <h2 class="subtitulo">Número de matrículas: <span>{{$solicitud->Curso_Rezago->numero_De_Matriculas}}</span></h2>
                    <h2 class="subtitulo">Grupo: <span>{{$solicitud->Curso_Rezago->grupo}}</span></h2>
                    <h2 class="subtitulo">Docente: <span>{{$solicitud->Curso_Rezago->docente}}</span></h2>
                    <h2 class="subtitulo">Considero que las razones por las cuales no he podido aprobar el curso son: <span>{{$solicitud->Curso_Rezago->resumen_No_Aprobar_El_Curso}}</span></h2>
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