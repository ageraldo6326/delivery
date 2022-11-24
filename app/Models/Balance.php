<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'fecha',
        'limite_diario',
        'limite_subsidio',
        'consumo_del_dia',
        'balance_del_dia',
        'consumo_del_mes',
        'balance_del_mes'
    ];
}
