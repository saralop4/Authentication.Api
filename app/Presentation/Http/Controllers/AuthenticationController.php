<?php

namespace App\Presentation\Http\Controllers;

use App\Domain\DTOs\UsuarioDto;
use App\Presentation\Http\Controllers\Controller;
use App\Application\Services\UsuarioService;


class AuthenticationController extends Controller{

    private $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function login(UsuarioDto $usuarioDto)
    {
        $response =  $this->usuarioService->loginUsuario($usuarioDto);
        return $response;
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


}
