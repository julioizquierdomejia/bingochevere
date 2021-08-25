<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'background_design',
        'logo_central',
        'url_register',
        'status',
        'cant',
        'color',
        'color_text',
        'cartones',

    ];

    //relacion de muchos a muchos
    function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
