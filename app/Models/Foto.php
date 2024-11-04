<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Articulo;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = ['articulo_id','ruta'];

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
}
