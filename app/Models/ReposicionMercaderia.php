<?php

namespace App\Models;

use App\Models\Talle;
use App\Models\Calzado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Relations\Pivot; (hay que IMPORT PIVOT ??)
class ReposicionMercaderia extends Model
{
    use HasFactory;
    protected $fillable = ['estado', 'id_categoria'];

    // Relación con Talla
    public function talles()
    {
        return $this->belongsTo(Talle::class);
    }

    // Relación con Calzado
    public function calzados()
    {
        return $this->belongsTo(Calzado::class);
    }

    // Relación con ArticuloStockRequest
    public function articulos()
    {
        return $this->belongsToMany(Articulo::class, 'articulo_reposicion_mercaderia')
                    ->withPivot('cantidad', 'talla_id', 'calzado_id', 'valor_calzado_talle', 'unidades_aceptadas')
                    ->withTimestamps();
    }
}
