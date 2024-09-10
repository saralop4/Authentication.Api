<?php

namespace App\Application\UseCases;

use App\Domain\Response\ApiResponse;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class MeUsuario
{
    public function execute()
    {
        // Obtener el usuario autenticado
        $usuario = JWTAuth::user();

        // Verificar si se ha obtenido un usuario
        if (!$usuario) {
            return ApiResponse::ResponseError('Usuario no autenticado', 401);
        }

        // Puedes devolver toda la información del usuario o solo ciertos campos
        $data = [
            'id' => $usuario->id,
            'name' => $usuario->name,
            'email' => $usuario->email,
        ];

        return ApiResponse::ResponseSuccess('Usuario Actual Exitoso', 200, $data);
    }
}
