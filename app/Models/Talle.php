<?php

namespace App\Models;

use App\Models\Articulo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Talle extends Model
{
    use HasFactory;
    protected $fillable = ['talle_ropa','largo_cm', 'ancho_cm', 'genero','cintura_para'];

    public function articulos()
    {
        return $this->belongsToMany(Articulo::class)->withPivot('stocks');
    }

}
