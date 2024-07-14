<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre', 'apellido1', 'apellido2', 'email', 'password', 'ubicacion', 'usuario', 'ultima_ubicacion'
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