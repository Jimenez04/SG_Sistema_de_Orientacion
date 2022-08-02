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

Route::post('register', [UsuarioController::class, 'register']);
Route::post('login', [UsuarioController::class, 'login']);

Route::middleware(['auth:api', 'role'])->group(function () {
    Route::get('get-user', [UsuarioController::class, 'userInfo']);
    Route::post('user/change_password', [UsuarioController::class, 'change_password']);

    Route::get('personas', [PersonaController::class, 'index'])->middleware('role:Administrador');
    Route::post('personas', [PersonaController::class, 'Post'])->middleware('role:Administrador');
    Route::post('Admin/Register', [UsuarioController::class, 'registerUserFromAdmin'])->middleware('role:Administrador');
//  Route::resource('personas', [PersonaController::class]);
});


  /*   Route::post('register', [UsuarioController::class, 'register']);
    Route::post('login', [UsuarioController::class, 'login']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('get-user', [UsuarioController::class, 'userInfo']);
 
    Route::get('personas', [PersonaController::class, 'index']);
}); */
