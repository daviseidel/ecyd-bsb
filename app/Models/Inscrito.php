<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscrito extends Model
{
    protected $fillable = [
        'membro_id',
        'evento_id',
        'pagamento_confirmado',
        'data_inscricao'
    ];

    public function membro()
    {
        return $this->belongsTo(Membro::class);
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}
