<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalles extends Model
{
    use HasFactory;


    protected $fillable = [
       'id',
        'producto_id',
        'producto_nombre',
        'cantidad',
        'precio',
        'pedido_id',
        'pedido_codigo',
        'user_id',
        'user_nombre',
        'proveedor_id',
        'proveedor_nombre',
        'subtotal',
        'impuestos',
        'total'
        ];


}
