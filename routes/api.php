<?php

use App\Http\Controllers\Api\PersonaController;
use App\Http\Controllers\Api\UsuarioController;
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
    Route::get('obtener-usuarios', [UsuarioController::class, 'userInfo']);
    Route::post('user/cambiar-contrasena', [UsuarioController::class, 'change_password']);
    Route::post('admin/user/cambiar-contrasena', [UsuarioController::class, 'change_password'])->middleware('scopes:Administrador');
    Route::post('admin/registrar', [UsuarioController::class, 'registerUserFromAdmin'])->middleware('scopes:Administrador');

    Route::get('persona', [PersonaController::class, 'index'])->middleware('scopes:Administrador');
    Route::get('persona/{cedula}', [PersonaController::class, 'get'])->middleware('scopes:Administrador');
    Route::post('persona', [PersonaController::class, 'Post'])->middleware('scopes:Administrador');
    Route::patch('persona/editar', [PersonaController::class, 'Pacth']);
    Route::patch('admin/persona/editar', [PersonaController::class, 'Pacth_Admin'])->middleware('scopes:Administrador');

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

    //Beca //no quitar scope de estudiante...
    Route::get('admin/persona/estudiante/beca/{carnet}', [UsuarioController::class, 'get_grant']);

    Route::post('user/persona/estudiante/beca/agregar', [UsuarioController::class, 'add_Beca'])->middleware('scopes:Estudiante');
    Route::post('admin/user/persona/estudiante/beca/agregar', [UsuarioController::class, 'add_Beca_Admin'])->middleware('scopes:Administrador');

    Route::patch('usuario/persona/estudiante/beca/actualizar', [UsuarioController::class, 'grant_update']);
    //EndBeca



});
