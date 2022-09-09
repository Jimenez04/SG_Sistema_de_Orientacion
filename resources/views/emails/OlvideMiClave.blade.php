<!DOCTYPE html>
<html>
<head>
 <title>Contraseña temporal</title>
</head>
<body>

 <h1 class="titulo">Oficina de orientación, UCR, Sede Guanacaste</h1>

 <p style="font-family:arial; 
 font-weight: 500;
text-indent: 0.5rem; color:black; font-size:0.8rem; line-height: 1.5rem; ">{{$mensaje1}}</p>

<div style="
border: #2B6797 2px;
border-style: solid;
width: 60%;
margin: 0 auto;
padding:2rem;
" 
class="datospersonales ">
    <h1 style="margin-bottom: 1rem " class="titulo titulo_info_personal">Información</h1>
        <div>
            <h2 class="subtitulo">Contraseña Temporal: <span>{{$data['password']}}</span></h2>
            <h2 class="subtitulo">Fecha y Hora: <span>{{$data['time']}}</span></h2>

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
    {{$mensaje2}}
</p>

 
 
 <span style="font-family:arial; color:black; font-size:0.5rem;">Este mensaje es autogenerado, favor no contestar este mensaje.</span>

</body>
<style>
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
    span{
        font-size:.9rem; color:black; font-family:arial; font-weight:400;
    }
</style>
</html> 