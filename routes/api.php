<?php

use App\Http\Controllers\API\BitacoraController;
use App\Http\Controllers\Api\PersonaController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\SolicitudesAdecuacionController;
use App\Http\Controllers\API\SolicitudesPAIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('registrar', [UsuarioController::class, 'register']);

Route::post('login', [UsuarioController::class, 'login']);
Route::post('usuario/olvide-mi-contrasena', [UsuarioController::class, 'forget_Account']);

Route::middleware(['auth:api', 'verified'])->group(function () {
    // Route::middleware(['auth:api'])->group(function () {
    Route::get('usuario/salir', [UsuarioController::class, 'logOut']);
    Route::get('obtener-usuario', [UsuarioController::class, 'userInfo']);
    Route::post('user/cambiar-contrasena', [UsuarioController::class, 'change_password']);
    Route::post('admin/user/cambiar-contrasena', [UsuarioController::class, 'change_password'])->middleware('scopes:Administrador');
    Route::post('admin/registrar', [UsuarioController::class, 'registerUserFromAdmin'])->middleware('scopes:Administrador');

    //Solicitud de Adecuación.
    Route::post('user/persona/estudiante/adecuacion', [SolicitudesAdecuacionController::class, 'createSolicitudDeAdecuacion']);

    Route::delete('user/persona/estudiante/adecuacion/delete/{numSolicitud}', [SolicitudesAdecuacionController::class, 'destroy']);
    
    Route::get('user/persona/estudiante/adecuacion', [SolicitudesAdecuacionController::class, 'index']);
    
    Route::get('user/persona/estudiante/adecuacion/{id}', [SolicitudesAdecuacionController::class, 'show']);

    Route::get('user/admin/persona/estudiante/adecuacion/{carnet}', [SolicitudesAdecuacionController::class, 'showForCarnet'])->middleware('scope:Administrador');

    Route::patch('user/admin/persona/estudiante/adecuacion/{numSolicitud}/estado/actualizar', [SolicitudesAdecuacionController::class, 'updateState'])->middleware('scope:Administrador');

    //Observación
    Route::post('user/admin/persona/estudiante/adecuacion/{numsolicitud}/observacion', [SolicitudesAdecuacionController::class, 'addObservation'])->middleware('scope:Administrador');
   
    Route::delete('user/admin/persona/estudiante/adecuacion/{numsolicitud}/observacion/delete/{id}', [SolicitudesAdecuacionController::class, 'delete_Observation'])->middleware('scope:Administrador');

    Route::get('user/admin/persona/estudiante/adecuacion/{numsolicitud}/observacion/', [SolicitudesAdecuacionController::class, 'getAll_Observation'])->middleware('scope:Administrador');
    
    Route::get('user/admin/persona/estudiante/adecuacion/{numsolicitud}/observacion/{id}', [SolicitudesAdecuacionController::class, 'getObservation'])->middleware('scope:Administrador');

    Route::patch('user/admin/persona/estudiante/adecuacion/{numsolicitud}/observacion/{id}/actualizar', [SolicitudesAdecuacionController::class, 'update_Observation'])->middleware('scope:Administrador');
    //End   Observación

    //Recomendaciones
    Route::post('user/admin/persona/estudiante/adecuacion/{numsolicitud}/recomendacion', [SolicitudesAdecuacionController::class, 'addRecommendation'])->middleware('scope:Administrador');
   
    Route::delete('user/admin/persona/estudiante/adecuacion/{numsolicitud}/recomendacion/delete/{id}', [SolicitudesAdecuacionController::class, 'delete_Recommendation'])->middleware('scope:Administrador');

    Route::get('user/admin/persona/estudiante/adecuacion/{numsolicitud}/recomendacion/', [SolicitudesAdecuacionController::class, 'getAll_Recommendation'])->middleware('scope:Administrador');
    
    Route::get('user/admin/persona/estudiante/adecuacion/{numsolicitud}/recomendacion/{id}', [SolicitudesAdecuacionController::class, 'getRecommendation'])->middleware('scope:Administrador');

    Route::patch('user/admin/persona/estudiante/adecuacion/{numsolicitud}/recomendacion/{id}/actualizar', [SolicitudesAdecuacionController::class, 'update_Recommendation'])->middleware('scope:Administrador');
    //End   Recomendaciones
    
    //End solicitud de Adecuación.

    //PAI
    Route::post('user/persona/estudiante/pai', [SolicitudesPAIController::class, 'store']);

    Route::delete('user/persona/estudiante/pai/delete/{numSolicitud}', [SolicitudesPAIController::class, 'destroy'])->middleware('scope:Administrador');

    Route::get('user/persona/estudiante/pai', [SolicitudesPAIController ::class, 'index']);

    Route::get('user/persona/estudiante/pai/{id}', [SolicitudesPAIController ::class, 'show']);

    Route::get('user/admin/persona/estudiante/pai/{carnet}', [SolicitudesPAIController::class, 'showForCarnet'])->middleware('scope:Administrador');
    
    Route::patch('user/admin/persona/estudiante/pai/{numSolicitud}/estado/actualizar', [SolicitudesPAIController::class, 'updateState'])->middleware('scope:Administrador');


//resume
    Route::post('user/persona/admin/pai/{numsolicitud}/continuar', [SolicitudesPAIController::class, 'resume'])->middleware('scope:Administrador');
    Route::get('user/persona/admin/pai/banco/preguntas', [SolicitudesPAIController::class, 'question']);

    //End PAI

    //Bitacora
    Route::post('user/estudiante/solicitud/bitacora/{id}/agregar', [BitacoraController::class, 'store'])->middleware('scope:Administrador');
    Route::patch('user/estudiante/solicitud/bitacora/{id}/item/{itemid}/editar', [BitacoraController::class, 'update'])->middleware('scope:Administrador');
    Route::get('user/estudiante/solicitud/bitacora/{id}', [BitacoraController::class, 'index'])->middleware('scope:Administrador');
    Route::get('user/estudiante/solicitud/bitacora/{id}/item/{itemid}', [BitacoraController::class, 'show'])->middleware('scope:Administrador');
    //End Bitacora

    //Persona
    Route::get('persona', [PersonaController::class, 'index'])->middleware('scopes:Administrador');
    Route::get('persona/existe/{cedula}', [PersonaController::class, 'exist']);
    Route::get('persona/{cedula}', [PersonaController::class, 'get'])->middleware('scopes:Administrador');
    Route::post('persona', [PersonaController::class, 'Post']);
    Route::patch('persona/editar', [PersonaController::class, 'Pacth']);
    Route::patch('admin/persona/editar', [PersonaController::class, 'Pacth_Admin'])->middleware('scopes:Administrador');
    //EndPersona    

    ///////////////Email
    Route::post('admin/persona/email/agregar', [PersonaController::class, 'addEmailAdmin'])->middleware('scopes:Administrador');
    Route::post('user/email/agregar', [PersonaController::class, 'addEmailpersonal']);

    Route::get('user/obtener-email/{id}', [PersonaController::class, 'getEmail_Personal']);
    Route::get('user/obtener-emails', [PersonaController::class, 'getEmails_Personal']);

    Route::get('admin/persona/email/{cedula}', [PersonaController::class, 'getEmails_Admin'])->middleware('scopes:Administrador');
    Route::get('admin/persona/obtener-email/{cedula}/{id}', [PersonaController::class, 'getEmail_Admin'])->middleware('scopes:Administrador');

    Route::patch('user/modificar/email', [PersonaController::class, 'updateEmail_Personal'])->middleware('scopes:Estudiante');
    Route::patch('admin/modificar/email', [PersonaController::class, 'updateEmail_Admin'])->middleware('scopes:Administrador');

    Route::delete('user/eliminar/email/{id}', [PersonaController::class, 'deleteEmail_Personal'])->middleware('scopes:Estudiante');
    Route::delete('admin/eliminar/email/{cedula}/{id}', [PersonaController::class, 'deleteEmail_Admin'])->middleware('scopes:Administrador');
    ///////////////End Email

    ///////////////Contacto Telefono
    Route::post('admin/persona/telefono/agregar', [PersonaController::class, 'add_NumberAdmin'])->middleware('scopes:Administrador');
    Route::post('user/telefono/agregar', [PersonaController::class, 'add_NumberPersonal']);

    Route::get('admin/persona/obtener-telefono/{cedula}', [PersonaController::class, 'getNumbers_Admin'])->middleware('scopes:Administrador');
    Route::get('admin/persona/obtener-telefono/{cedula}/{id}', [PersonaController::class, 'get_number_Admin'])->middleware('scopes:Administrador');

    Route::get('user/obtener-telefono/{id}', [PersonaController::class, 'getnumber_Personal']);
    Route::get('user/obtener-telefono', [PersonaController::class, 'getNumbers_Personal']);

    Route::patch('user/modificar/telefono', [PersonaController::class, 'update_Number_Personal']);
    Route::patch('admin/modificar/telefono', [PersonaController::class, 'update_Number_Admin'])->middleware('scopes:Administrador');

    Route::delete('user/eliminar/telefono/{id}', [PersonaController::class, 'delete_Number_Personal']);
    Route::delete('admin/eliminar/telefono/{cedula}/{id}', [PersonaController::class, 'delete_Number_Admin'])->middleware('scopes:Administrador');
    ///////////////End Contacto Telefono

    ///////////////Enfermedad
    Route::post('admin/persona/enfermedad/agregar', [PersonaController::class, 'add_SicknessAdmin'])->middleware('scopes:Administrador');
    Route::post('user/enfermedad/agregar', [PersonaController::class, 'add_SicknessPersonal']);

    Route::get('admin/persona/obtener-enfermedad/{cedula}', [PersonaController::class, 'getSickness_Admin'])->middleware('scopes:Administrador');
    Route::get('admin/persona/obtener-enfermedad/{cedula}/{id}', [PersonaController::class, 'get_Sickness_Admin'])->middleware('scopes:Administrador');

    Route::get('user/obtener-enfermedad/{id}', [PersonaController::class, 'get_Sickness_Personal']);
    Route::get('user/obtener-enfermedad', [PersonaController::class, 'getSickness_Personal']);

    Route::patch('user/editar/enfermedad', [PersonaController::class, 'updateSickness_Personal']);
    Route::patch('admin/editar/enfermedad', [PersonaController::class, 'update_Sickness_Admin'])->middleware('scopes:Administrador');

    Route::delete('user/eliminar/enfermedad/{id}', [PersonaController::class, 'delete_Sickness_Personal']);
    Route::delete('admin/eliminar/enfermedad/{cedula}/{id}', [PersonaController::class, 'delete_Sickness_Admin'])->middleware('scopes:Administrador');
    ///////////////Enfermedad

    ///////////////Trabajo
    Route::post('admin/persona/trabajo/agregar', [PersonaController::class, 'add_JobAdmin'])->middleware('scopes:Administrador');
    Route::post('user/trabajo/agregar', [PersonaController::class, 'add_JobPersonal']);

    Route::get('admin/persona/trabajo/{cedula}', [PersonaController::class, 'getJobs_Admin'])->middleware('scopes:Administrador');
    Route::get('admin/persona/trabajo/{cedula}/{id}', [PersonaController::class, 'get_Job_Admin'])->middleware('scopes:Administrador');

    Route::get('user/trabajo/{id}', [PersonaController::class, 'get_Job_Personal']);
    Route::get('user/trabajo', [PersonaController::class, 'getJobs_Personal']);

    Route::patch('user/editar/trabajo', [PersonaController::class, 'updateJob_Personal']);
    Route::patch('admin/editar/trabajo', [PersonaController::class, 'update_Job_Admin'])->middleware('scopes:Administrador');

    Route::delete('user/eliminar/trabajo/{id}', [PersonaController::class, 'delete_Job_Personal']);
    Route::delete('admin/eliminar/trabajo/{cedula}/{id}', [PersonaController::class, 'delete_Job_Admin'])->middleware('scopes:Administrador');
    ///////////////End Trabajo




    Route::delete('user/delete/{id}', [UsuarioController::class, 'deleteuser_fromAdmin'])->middleware('scopes:Administrador');
    Route::patch('user/validate/{id}', [UsuarioController::class, 'validate_user'])->middleware('scopes:Administrador');

    //student
    Route::get('admin/persona/estudiante', [UsuarioController::class, 'get_students'])->middleware('scopes:Administrador');
    Route::get('user/persona/estudiante/{carnet}', [UsuarioController::class, 'get_student']);

    Route::patch('usuario/persona/estudiante/actualizar', [UsuarioController::class, 'student_update']);


    //end student

    //Beca
    Route::get('admin/persona/estudiante/beca/{carnet}', [UsuarioController::class, 'get_grant']);

    Route::post('user/persona/estudiante/beca/agregar', [UsuarioController::class, 'add_Beca'])->middleware('scopes:Estudiante');
    Route::post('admin/user/persona/estudiante/beca/agregar', [UsuarioController::class, 'add_Beca_Admin'])->middleware('scopes:Administrador');

    Route::patch('usuario/persona/estudiante/beca/actualizar', [UsuarioController::class, 'grant_update']);
    //EndBeca

});
