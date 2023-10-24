<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observacao extends Model
{
    protected $table = 'observacoes';
    
    protected $fillable = [
        'observacao',
        'data_preenchimento',
        'paciente_id'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
