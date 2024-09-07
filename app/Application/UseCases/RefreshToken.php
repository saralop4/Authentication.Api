<?php

namespace App\Application\UseCases;

use App\Domain\Response\ApiResponse;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class RefreshToken
{
    public function execute(Request $request)
    {
        // Obtener el token actual del encabezado de la solicitud
        $token = $request->bearerToken();

        // Verificar si el token está presente
        if (!$token) {
            return ApiResponse::ResponseError('Token no proporcionado', 401);
        }

        try {
            // Refresca el token y obtiene el nuevo token
            $newToken = JWTAuth::refresh($token);

            $data = [
                'access_token' => $newToken,
                'token_type' => 'bearer',
                'expires_in' => JWTAuth::factory()->getTTL() * 60 // EL TOKEN DURA 60 MINUTOS
            ];

            return ApiResponse::ResponseSuccess('Token Refrescado', 200, $data);
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException $e) {
            return ApiResponse::ResponseError('Token inválido', 401);
        }
    }
}
