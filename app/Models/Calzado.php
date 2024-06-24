<?php

namespace App\Models;

use App\Models\Venta;
use App\Models\Articulo;
use App\Models\ReposicionMercaderia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Calzado extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'calzado'];

    public function articulos()
    {
        return $this->belongsToMany(Articulo::class)->withPivot('stocks', 'precio');
    }

    
    // Relación con ArticuloStockRequest
    public function reposicionMercaderia()
    {
        return $this->hasMany(ReposicionMercaderia::class);
    }

}
