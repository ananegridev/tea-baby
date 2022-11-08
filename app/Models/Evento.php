<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable= [
        'mes_gestacao',
        'sexo_bebe',
        'data_evento',
        'nome_baby',
        'link_pagina',
        'titulo',
        'sobre',
        'celular',

        'cep',
        'endereco',
        'numero_endereco',
        'complemento',
        'cidade',
        'estado',
        'ponto_referencia',

        'categoria_evento_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function convidados()
    {
        return $this->hasMany(Convidado::class);
    }
}
