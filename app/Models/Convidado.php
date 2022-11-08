<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convidado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'telefone',
        'cod_convite',
        'qtd_presente',
        'presenca',
        'status',
        'tipo_convite',
        'presente_id',
        'evento_id',
    ];

    public function presente()
    {
        return $this->belongsTo(Presente::class);
    }
}
