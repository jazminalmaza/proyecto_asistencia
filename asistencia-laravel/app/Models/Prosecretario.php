<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Prosecretario extends Authenticatable
{
    protected $table = 'prosecretario';
    protected $primaryKey = 'id_prosecretario';

    // Para que Laravel sepa qué campos usar en el login
    protected $fillable = [
        'usuario',
        'contraseña',
        'nombre',
        'apellido',
    ];

    // Laravel espera por defecto la columna 'password', especificamos la tuya:
    public function getAuthPassword()
    {
        return $this->contraseña;
    }
}
