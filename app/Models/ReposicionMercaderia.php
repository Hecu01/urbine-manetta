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
}
