<?php

namespace App\Application\UseCases;

use App\Domain\Response\ApiResponse;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

class RefreshToken
{
    public function execute()
    {
        try {
            // Obtener el token actual desde el encabezado de la solicitud
            $token = JWTAuth::getToken();

            // Si no hay token, devolver error
            if (!$token) {
                return ApiResponse::ResponseError('Token no proporcionado', 401);
            }

            // Se refresca el token
            $nuevoToken = JWTAuth::refresh($token);


            $data = [
                'access_token' => $nuevoToken,
                'token_type' => 'bearer',
                'expires_in' => JWTAuth::factory()->getTTL() * 60, // Tiempo de vida del token en segundos
            ];

            return ApiResponse::ResponseSuccess('Token Refrescado', 200, $data);
        } catch (TokenInvalidException $e) {
            return ApiResponse::ResponseError('Token inválido', 401);
        } catch (JWTException $e) {
            return ApiResponse::ResponseError('No se pudo refrescar el token', 500);
        }
    }
}
