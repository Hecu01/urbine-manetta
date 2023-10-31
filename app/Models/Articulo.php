<?php

namespace App\Models;

use App\Models\Calzado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articulo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'genero', 'precio', 'stock', 'marca','color','id_categoria', 'foto', 'dirigido_a','tipo_producto'];
    public function calzados()
    {
        return $this->belongsToMany(Calzado::class)->withPivot('stocks');
    }
}
