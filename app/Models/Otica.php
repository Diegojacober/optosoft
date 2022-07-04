<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
