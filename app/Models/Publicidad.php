<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicidad extends Model
{
    use HasFactory;

    // Define la tabla
    protected $table = 'publicidades';


    protected $fillable = [
        'nombre',
        'foto',
        'url',
    ];
}
