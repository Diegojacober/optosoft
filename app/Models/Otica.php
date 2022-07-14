<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Otica extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'cidade',
        'optometrist_id',
        'ativo'
    ];

    public function optometrist()
    {
        return $this->belongsTo(Optometrist::class);
    }

    public function receitas()
    {
        return $this->hasMany(Receita::class);
    }

    public function exames()
    {
        return $this->hasMany(Exame::class);
    }

}
