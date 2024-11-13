<?php

namespace App\Models;

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
                ->withPivot('cantidad', 'precio_unitario');
    }
}
