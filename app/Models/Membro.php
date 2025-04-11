<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membro extends Model
{
    protected $fillable = [
        'user_id',
        'nome',
        'cpf',
        'celular',
        'restricao_alimentar',
        'etapa_ecyd',
        'idade'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inscricoes()
    {
        return $this->hasMany(Inscrito::class);
    }
}
