<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LDAP\Result;

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

    public function oticas()
    {
        return $this->HasMany(Otica::class)->orderBy('id', 'DESC');;
    }

    public function receitas()
    {
        return $this->HasMany(Receita::class);
    }

    public function pagamentos()
    {
        return $this->hasMany(Pagamento::class);
    }

    public function exames()
    {
        return $this->hasMany(Exame::class);
    }
}
