<?php

namespace App\Models;

use App\Models\Talle;
use App\Models\Venta;
use App\Models\Calzado;
use App\Models\Deporte;
use App\Models\Descuento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articulo extends Model
{
    use HasFactory;
    protected $fillable = [
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

    // Vincular los calzados
    public function calzados(){
        return $this->belongsToMany(Calzado::class)->withPivot('stocks', 'precio');
    }

    // Vincular los talles
    public function talles(){
        return $this->belongsToMany(Talle::class)->withPivot('stocks');
    }

    // Vincular descuentos
    public function descuento(){
        return $this->hasOne(Descuento::class);
    }

   // Define la relación con Deporte
   public function deportes()
   {
       return $this->belongsToMany(Deporte::class);
   }
    // Relación con las ventas en las que se ha vendido este producto
    public function ventas()
    {
        return $this->belongsToMany(Venta::class, 'venta_articulo')->withPivot('cantidad', 'precio_unitario');
    }
}
