<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DescuentoUsuario extends Model
{
    protected $fillable = ['profesion_usuario', 'motivo_descuento', 'foto_certificado', 'descuento_activo', 'porcentaje_descuento', 'user_id'];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
