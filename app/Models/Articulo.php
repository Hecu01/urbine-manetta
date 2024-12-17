<?php

namespace App\Models;

use App\Models\Talle;
use App\Models\Venta;
use App\Models\Calzado;
use App\Models\Deporte;
use App\Models\Descuento;
use App\Models\Foto;
use App\Models\ReposicionMercaderia;
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
        'descripcion',
        'dirigido_a',
        'tipo_producto',
        'compra_id',
    ];

    // Vincular los calzados
    public function calzados()
    {
        return $this->belongsToMany(Calzado::class)->withPivot('stocks');
    }

    // Vincular los talles
    public function talles()
    {
        return $this->belongsToMany(Talle::class)->withPivot('stocks');
    }


    // Vincular los calzados
    // public function calzadosPDF()
    // {
    //     return $this->belongsToMany(Calzado::class, 'articulo_compra', 'articulo_id', 'calzado_id');
    // }

    // // Vincular los talles
    // public function tallesPDF()
    // {
    //     return $this->belongsToMany(Talle::class, 'articulo_compra', 'articulo_id', 'talle_id');
    // }
    
    // Vincular descuentos
    public function descuento()
    {
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

    // Relación con ReposicionMercaderia
    public function reposiciones()
    {
        return $this->belongsToMany(ReposicionMercaderia::class, 'articulo_reposicion_mercaderia')
            ->withPivot('cantidad', 'talla_id', 'calzado_id', 'unidades_aceptadas')
            ->withTimestamps();
    }

    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'articulo_compra')
            ->withPivot('cantidad', 'precio_unitario', 'talle_id', 'calzado_id');
    }

    // Relacion con una o varias imagenes
    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }
}