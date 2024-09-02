<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    protected $fillable = [
        'nombre',
        'apellido1',
        'apellido2',
        'email',
        'password',
        'ubicacion',
        'usuario',
        'ultima_ubicacion'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function familiares()
    {
        return $this->belongsToMany(Familiar::class, 'clientes_familiares', 'clientes_id', 'familiares_id');
    }

    public function codigos()
    {
        return $this->hasMany(CodigoCliente::class, 'clientes_id');
    }

    public function accidentes()
    {
        return $this->hasMany(Accidente::class, 'clientes_id');
    }
}
