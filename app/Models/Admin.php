<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = [
        'usuario', 'email', 'password'
    ];

    public function accidentes()
    {
        return $this->hasMany(Accidente::class, 'admin_id');
    }
}