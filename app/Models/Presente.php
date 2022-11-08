<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'total',
        'categoria_presente_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaPresente::class, 'categoria_presente_id', 'id');
    }
}
