<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'precio',
        'unidad',
        'fotourl',
        'proveedor_id',
        'categoria_id',
        'visitas'
        ];

}
