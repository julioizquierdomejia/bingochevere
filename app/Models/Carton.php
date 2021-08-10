<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carton extends Model
{
    use HasFactory;

    protected $fillable = [
        'fila1',
        'fila2',
        'fila3',
        'fila4',
        'fila5',
        'user_id',
        'codigo',
        'campaign_id',
        'empresa_id',

    ];
}
