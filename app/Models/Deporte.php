<?php

namespace App\Models;

use App\Models\Articulo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deporte extends Model
{
    use HasFactory;
    protected $fillable = ['deporte', 'categoria_deporte'];
    
    // Define la relación con Articulo
    public function articulos()
    {
        return $this->belongsToMany(Articulo::class)->withPivot('cantidad');
    }
}
