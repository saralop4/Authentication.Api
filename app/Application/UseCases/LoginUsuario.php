<?php

namespace App\Application\UseCases;

use Illuminate\Validation\ValidationException;
use App\Domain\Response\ApiResponse;
use App\Domain\DTOs\UsuarioDto;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use Exception;

class LoginUsuario
{


    public function execute(UsuarioDto $usuarioDto)
    {

        $credentials = ['correo' => $usuarioDto->correo, 'password' => $usuarioDto->contraseña];

       try {

            if (! $token = JWTAuth::attempt($credentials)) {
                return ApiResponse::ResponseError('Usuario no autorizado', 400);
            }

        } catch (ValidationException $ex) {
            $erroresValidaciones = $ex->validator->errors()->toArray();
            return ApiResponse::ResponseError('Error de validación - ' . $ex->getMessage(), 422, $erroresValidaciones);
        } catch (Exception $ex) {
            return ApiResponse::ResponseError('Hubo un error y no se pudo crear el registro - ' . $ex->getMessage(), 500);
        } catch (JWTException $ex) {
            return ApiResponse::ResponseError('No se pudo crear el token - ' . $ex->getMessage(), 500);
        }

        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60 // EL TOKEN DURA 60 MINUTOS
        ];

        return ApiResponse::ResponseSuccess('token exitoso', 200, $data);

    }

}
