<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaEvento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'icone',
        'descricao',
        'assinatura',
    ];
    
    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }
}
