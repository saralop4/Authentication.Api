<?php

namespace App\Domain\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Validation\ValidationException;

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
    public function getCorreo():string
    {
        return $this->correo;
    }
    public function getContraseña(): string
    {
        return $this->contraseña;
    }
    public function setCorreo($correo) : void
    {
         $this->correo=$correo;
    }
    public function setContraseña($contraseña) : void
    {
        $this->contraseña = $contraseña;
    }
    public static function from(array $data): self
    {
        $instance = new self();

        // Validar los datos
        $validator = Validator::make($data, self::rules());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // Asignar los valores a las propiedades
        $instance->correo = $data['correo'];
        $instance->contraseña = $data['contraseña'];

        return $instance;
    }

}
