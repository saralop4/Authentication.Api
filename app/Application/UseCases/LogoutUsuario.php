<?php

namespace App\Application\UseCases;

use App\Domain\Response\ApiResponse;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

class LogoutUsuario
{


    public function execute()
    {
        try{
            
            //el token será revocado y no será vaido para futuras solicitudes
            JWTAuth::invalidate(JWTAuth::getToken());
            return ApiResponse::ResponseSuccess('Cierre de sesión con éxito', 200);

        } catch (JWTException $e) {
            return ApiResponse::ResponseError('No se pudo refrescar el token', 500);
        }

    }
}
