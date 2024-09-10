<?php

use Illuminate\Support\Facades\Route;
use App\Presentation\Http\Controllers\AuthenticationController;

/*
Route::prefix('v1')->group(function () {
    Route::post('/iniciarSesion', [AuthenticationController::class, 'login']);
    Route::post('/obtenerUsuarioActual', [AuthenticationController::class, 'me'])->middleware('auth:api');
    Route::post('/cerrarSesion', [AuthenticationController::class, 'logout'])->middleware('auth:api');
    Route::post('/refreshToken', [AuthenticationController::class, 'refreshToken'])->middleware('auth:api');
    Route::get('/obtenerMensaje',function(){
        return 'Hola Mundo';
    });
});
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'
], function ($router) {
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::post('/logout', [AuthenticationController::class, 'logout'])->middleware('auth:api');
    Route::post('/refreshToken', [AuthenticationController::class, 'refreshToken'])->middleware('auth:api');
    Route::post('/me', [AuthenticationController::class, 'me'])->middleware('auth:api');
     Route::get('/obtenerMensaje',function(){
        return 'Hola Mundo';
    });
});
