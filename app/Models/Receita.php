<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'idade',
        'od_esferico',
        'od_cilindrico',
        'od_eixo',
        'oe_esferico',
        'oe_cilindrico',
        'oe_eixo',
        'adicao',
        'obs',
        'optometrist_id',
        'otica_id',
        'ac',
        'acd',
        'ace',
    ];

    public function optometrist()
    {
        return $this->belongsTo(Optometrist::class);
    }

    public function Otica()
    {
        return $this->belongsTo(Otica::class);
    }

    public static function receitasHoje($optoID)
    {
        return Receita::where('created_at','>=',date('Y-m-d 00:00:00'))->where('created_at','<=',date('Y-m-d 23:59:00'))->where('optometrist_id',$optoID)->count();
    }
}
