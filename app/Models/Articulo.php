<?php

namespace App\Models;

use App\Models\Talle;
use App\Models\Calzado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articulo extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nombre', 
        'genero', 
        'precio', 
        'stock', 
        'marca',
        'color',
        'id_categoria', 
        'foto', 
        'dirigido_a',
        'tipo_producto'
    ];
    public function calzados(){
        return $this->belongsToMany(Calzado::class)->withPivot('stocks');
    }
    public function talles(){
        return $this->belongsToMany(Talle::class)->withPivot('stocks');
    }

}
