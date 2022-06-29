<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;


    public function optometrist()
    {
        return $this->belongsTo(Optometrist::class);
    }

    public function Otica()
    {
        return $this->belongsTo(Otica::class);
    }
}
