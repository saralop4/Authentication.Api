<?php

namespace App\Application\Services;

use App\Application\UseCases\LoginUsuario;
use App\Application\UseCases\LogoutUsuario;
use App\Application\UseCases\MeUsuario;
use App\Application\UseCases\RefreshToken;
use App\Domain\DTOs\UsuarioDto;
use Illuminate\Http\Request;

class UsuarioService{

    private $loginUsuario;
    private $logoutUsuario;
    private $meUsuario;
    private $refreshToken;

    public function __construct(
        LoginUsuario $loginUsuario,
        LogoutUsuario $logoutUsuario,
        MeUsuario $meUsuario,
        RefreshToken $refreshToken
    )
    {
        $this->loginUsuario = $loginUsuario;
        $this->logoutUsuario = $logoutUsuario;
        $this->meUsuario = $meUsuario;
        $this->refreshToken = $refreshToken;
    }

    public function loginUsuario(UsuarioDto $usuarioDto){

        return $this->loginUsuario->execute($usuarioDto);
    }

    public function logoutUsuario()
    {
        return $this->logoutUsuario->execute();
    }

    public function meUsuario()
    {
        return $this->meUsuario->execute();
    }

    public function refreshToken(Request $request)
    {
        return $this->refreshToken->execute($request);
    }

}

