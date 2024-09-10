<?php

namespace App\Domain\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class UsuarioDto extends ValidatedDTO
{
    private string $correo;
    private string $contraseña;


    //Este método define las reglas de validación para los datos que se asignan al DTO (Data Transfer Object).
    protected function rules(): array
    {
        return [
            'correo' => 'required|email|max:80|unique:usuarios',
            'contraseña' => 'required|max:40|min:8',
        ];
    }

    //este método define los valores predeterminados para las propiedades del DTO
    protected function defaults(): array
    {
        return [];
    }

    //Este método define cómo se deben convertir las propiedades del DTO cuando se asignan.
    protected function casts(): array
    {
        return [];
    }
    public function getCorreo()
    {
        return $this->correo;
    }
    public function getContraseña()
    {
        return $this->contraseña;
    }
}
