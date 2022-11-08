<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PixUsuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_chave',
        'chave',
        'valor',
        'qrcode',
        'user_id'
    ];
}
