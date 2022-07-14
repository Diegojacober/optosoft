<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exame extends Model
{
    use HasFactory;

    protected $fillable = [
        'otica_id',
        'optometrist_id',
        'title',
        'idade',
        'telefone',
        'anotacao',
        'start',
        'end',
        'color',
        'confirmado'
    ];

    public static function consultasHoje($optoId) 
    {
        return Exame::where('optometrist_id',$optoId)->where('start','>',date('Y-m-d 00:00:00'))->where('end','<',date('Y-m-d 23:59:00'))->where('confirmado','1')->count();
    }
}
