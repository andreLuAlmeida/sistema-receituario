<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescricao extends Model
{
    use HasFactory;
    protected $table = 'prescricoes';

    protected $fillable = [
        'via_administracao',
        'nome_medicamento',
        'dose',
        'forma_farmaceutica',
        'quantidade_total',
        'frequencia_administracao',
        'duracao_tratamento',
        'instrucoes_cuidados',
        'horario',
        'intervalo_tempo',
        'quantidade_doses',
        'outras_orientacoes',
        'receita_id',
    ];

    public function receita()
    {
        return $this->belongsTo(Receita::class);
    }
}