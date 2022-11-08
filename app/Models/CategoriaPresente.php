<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaPresente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'user_id',
        'evento_id'
    ];

    public function presentes()
    {
        return $this->hasMany(Presente::class);
    }
}
