<?php

use Illuminate\Support\Facades\Route;
use App\Presentation\Http\Controllers\AuthenticationController;

Route::middleware(['jwt.auth'])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::get('/obtenerUsuarioActual', [AuthenticationController::class, 'me']);
        Route::post('/cerrarSesion', [AuthenticationController::class, 'logout']);
    });
});

Route::post('/iniciarSesion', [AuthenticationController::class, 'login']);
Route::post('/refreshToken', [AuthenticationController::class, 'refreshToken']);


