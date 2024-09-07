<?php

namespace App\Application\UseCases;

use App\Domain\Response\ApiResponse;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class MeUsuario
{

    public function execute()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return ApiResponse::ResponseSuccess('Usuario Actual Exitoso', 200, JWTAuth::user());
    }
}
