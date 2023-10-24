<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'sobrenome',
        'cpf',
        'data_nascimento',
        'idade',
        'sexo',
        'profissao',
        'rg',
        'email',
        'telefone',
        'celular',
        'cep',
        'estado',
        'cidade',
        'bairro',
        'rua',
        'numero_residencial',
        'informacoes_medicas',
        'medicos_id',
    ];

    // Relação com o modelo "Medico"
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medicos_id');
    }

    // Relação 1 para N com a model "Receita"
    public function receitas()
    {
        return $this->hasMany(Receita::class);
    }
}

