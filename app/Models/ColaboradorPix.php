<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColaboradorPix extends Model
{
    use HasFactory;

    protected $table = 'colaboradores_pix';

    protected $fillable= [
        'nome_pix',
        'valor',
        'status',
        'evento_id'
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
