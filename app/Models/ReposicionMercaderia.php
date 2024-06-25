<?php

namespace App\Models;

use App\Models\Talle;
use App\Models\Calzado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Relations\Pivot; (IMPORT PIVOT ??)
class ReposicionMercaderia extends Model
{
    use HasFactory;
    protected $fillable = ['articulo_id', 'reposicion_mercaderia_id', 'cantidad', 'talla_id', 'calzado_id'];

    // Relación con Talla
    public function talla()
    {
        return $this->belongsTo(Talle::class);
    }

    // Relación con Calzado
    public function calzado()
    {
        return $this->belongsTo(Calzado::class);
    }

    // Relación con ArticuloStockRequest
    public function articulos()
    {
        return $this->belongsToMany(Articulo::class, 'articulo_reposicion_mercaderias')
                    ->withPivot('cantidad', 'talla_id', 'calzado_id')
                    ->withTimestamps();
    }
}
