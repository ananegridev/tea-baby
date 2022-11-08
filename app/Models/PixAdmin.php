<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PixAdmin extends Model
{
    use HasFactory;

    protected $table= 'pix_admin';

    protected $fillable = [
        'tipo_chave',
        'chave',
        'valor',
        'qrcode',
    ];
}
