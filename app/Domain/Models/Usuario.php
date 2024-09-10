<?php

namespace App\Domain\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;


class Usuario extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'idRol',
        'nombre',
        'apellido',
        'telefono',
        'correo',
        'contraseña',
        'estadoEliminado',
        'usuarioQueRegistra',
        'usuarioQueActualiza',
        'fechaDeRegistro',
        'horaDeRegistro',
        'ipDeRegistro',
        'fechaDeActualizado',
        'horaDeActualizado',
        'ipDeActualizado',

    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
