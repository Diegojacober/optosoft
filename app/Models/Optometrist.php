<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optometrist extends Model
{
    use HasFactory;

    protected $table = 'optometristas';

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'phone',
        'pago',
        'photo',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
