<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otica extends Model
{
    use HasFactory;


    public function optometrist()
    {
        return $this->belongsTo(Optometrist::class);
    }
}
