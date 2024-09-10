<?php

namespace App\Presentation\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Domain\DTOs\UsuarioDto;
use App\Domain\Response\ApiResponse;
use App\Application\Services\UsuarioService;
use Illuminate\Validation\ValidationException;
use App\Presentation\Http\Controllers\Controller;
use Symfony\Component\Console\Output\ConsoleOutput;



class AuthenticationController extends Controller{

    private $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function login(Request $request)
    {
        $out = new ConsoleOutput();
        $out->writeln("Hola desde la consola de Laravel");
        try {

            $out->writeln("entró");
            $data = $request->only(['correo', 'contraseña']);

            // Crear el DTO manualmente
            $usuarioDto = new UsuarioDto();
            $usuarioDto->setCorreo($data['correo']);
            $usuarioDto->setContraseña($data['contraseña']);

            $out->writeln("entró 2");


            $response = $this->usuarioService->loginUsuario($usuarioDto);
            return $response;

        } catch (ValidationException ) {
            return  ApiResponse::ResponseError('Error de validación', 422);
        } catch (Exception ) {
            return  ApiResponse::ResponseError('Error en el servidor', 500);
        }
    }


    public function logout()
    {
       $response =  $this->usuarioService->logoutUsuario();
       return $response;
    }

    public function me()
    {
        $response =  $this->usuarioService->meUsuario();
        return $response;
    }

    public function refreshToken()
    {
        $response =  $this->usuarioService->refreshToken();
        return $response;
    }

    public function obtenerMensaje(){
        return 'Hola desde el controller';
    }


}
