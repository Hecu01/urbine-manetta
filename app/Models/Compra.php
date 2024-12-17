<?php

namespace App\Models;

use App\Models\Talle;
use App\Models\Venta;
use App\Models\Calzado;
use App\Models\Deporte;
use App\Models\Descuento;
use App\Models\Foto;
use App\Models\ReposicionMercaderia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'fecha',
        'user_id', 
        'estado',
    ];
    
    public function articulos()
    {
        return $this->belongsToMany(Articulo::class, 'articulo_compra')
                ->withPivot('cantidad', 'precio_unitario', 'talle_id', 'calzado_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

