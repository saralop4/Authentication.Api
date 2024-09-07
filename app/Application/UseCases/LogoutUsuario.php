<?php

namespace App\Application\UseCases;

use App\Domain\Response\ApiResponse;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class LogoutUsuario
{


    public function execute()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return ApiResponse::ResponseSuccess('Cierre de sesión con éxito', 200);
    }
}
