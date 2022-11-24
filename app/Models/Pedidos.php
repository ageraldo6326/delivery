<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'codigo',
        'subtotal',
        'impuestos',
        'total',
        'user_id',
        'user_nombre',
        'estado',
        'credito',
        'subsidio',
        'nosubsidio'
        ];
    
}
