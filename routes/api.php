<?php

use App\Http\Controllers\Api\PersonaController;
use App\Http\Controllers\Api\UsuarioController;
use Illuminate\Http\Request;
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

Route::middleware(['auth:api'])->group(function () {
    Route::get('get-user', [UsuarioController::class, 'userInfo']);
    Route::post('user/change_password', [UsuarioController::class, 'change_password']);
    Route::post('admin/registrar', [UsuarioController::class, 'registerUserFromAdmin'])->middleware('scopes:Administrador');

    Route::get('persona', [PersonaController::class, 'index'])->middleware('scopes:Administrador');
    Route::post('persona', [PersonaController::class, 'Post'])->middleware('scopes:Administrador');
    
    ///////////////Email
    Route::post('admin/persona/email/agregar', [PersonaController::class, 'addEmailAdmin'])->middleware('scopes:Administrador');
    Route::post('user/email/agregar', [PersonaController::class, 'addEmailpersonal'])->middleware('scopes:Estudiante');

    Route::get('user/email/{id}', [PersonaController::class, 'getEmail_Personal'])->middleware('scopes:Estudiante');
    Route::get('user/email', [PersonaController::class, 'getEmails_Personal'])->middleware('scopes:Estudiante');

    Route::get('admin/persona/email/{cedula}', [PersonaController::class, 'getEmails_Admin'])->middleware('scopes:Administrador');
    Route::get('admin/persona/email/{cedula}/{id}', [PersonaController::class, 'getEmail_Admin'])->middleware('scopes:Administrador');

    Route::patch('user/update/email', [PersonaController::class, 'updateEmail_Personal'])->middleware('scopes:Estudiante');
     Route::patch('admin/update/email', [PersonaController::class, 'updateEmail_Admin'])->middleware('scopes:Administrador');

    Route::delete('user/delete/email/{id}', [PersonaController::class, 'deleteEmail_Personal'])->middleware('scopes:Estudiante');
     Route::delete('admin/delete/email/{cedula}/{id}', [PersonaController::class, 'deleteEmail_Admin'])->middleware('scopes:Administrador');
    ///////////////End Email

    ///////////////Contacto Telefono
    Route::post('admin/persona/telefono/agregar', [PersonaController::class, 'add_NumberAdmin'])->middleware('scopes:Administrador');
    Route::post('user/telefono/agregar', [PersonaController::class, 'add_NumberPersonal'])->middleware('scopes:Estudiante');

    Route::get('admin/persona/telefono/{cedula}', [PersonaController::class, 'getNumbers_Admin'])->middleware('scopes:Administrador');
    Route::get('admin/persona/telefono/{cedula}/{id}', [PersonaController::class, 'get_number_Admin'])->middleware('scopes:Administrador');

    Route::get('user/telefono/{id}', [PersonaController::class, 'getnumber_Personal'])->middleware('scopes:Estudiante');
    Route::get('user/telefono', [PersonaController::class, 'getNumbers_Personal'])->middleware('scopes:Estudiante');

    Route::patch('user/update/telefono', [PersonaController::class, 'update_Number_Personal'])->middleware('scopes:Estudiante');
     Route::patch('admin/update/telefono', [PersonaController::class, 'update_Number_Admin'])->middleware('scopes:Administrador');

    Route::delete('user/delete/telefono/{id}', [PersonaController::class, 'delete_Number_Personal'])->middleware('scopes:Estudiante');
     Route::delete('admin/delete/telefono/{cedula}/{id}', [PersonaController::class, 'delete_Number_Admin'])->middleware('scopes:Administrador');

    ///////////////End Contacto Telefono
});