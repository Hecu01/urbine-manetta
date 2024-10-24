<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Domicilio extends Model
{
    protected $fillable = ['calle', 'barrio', 'departamento', 'piso', 'ciudad' , 'provincia', 'pais', 'codigo_postal', 'user_id'];

    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    
    }
}
