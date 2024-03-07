<?php

namespace App\Models;

use App\Models\Articulo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Descuento extends Model
{
    use HasFactory;
    protected $fillable = ['porcentaje', 'plata_descuento', 'activo'];

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
}
