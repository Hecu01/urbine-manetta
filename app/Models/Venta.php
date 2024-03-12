<?php

namespace App\Models;

use App\Models\User;
use App\Models\Articulo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venta extends Model
{

    
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nombre',
        'apellido',
        'dni',
        'unidades',
        'total',
        'payment_method',
        'invoice_number',
        'notes'
    ];
    // Relación con el cliente de la venta
    public function clientes()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con los productos vendidos en esta venta
    public function articulos()
    {
        return $this->belongsToMany(Articulo::class, 'venta_articulo')->withPivot('cantidad', 'precio_unitario');
    }
}
