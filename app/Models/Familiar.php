<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familiar extends Model
{
    use HasFactory;
    protected $table = 'familiares';
    protected $fillable = [
        'nombre',
        'apellido1',
        'apellido2',
        'email',
        'password',
        'estado',
        'ubicacion',
        'usuario',
        'ultima_ubicacion'
    ];

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'clientes_familiares', 'familiares_id', 'clientes_id');
    }
}
