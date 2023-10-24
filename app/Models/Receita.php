<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicos_id',
        'pacientes_id',
        'observacoes',
        'data_prescricao',
        'ativa',
        'token_aprovado',
        'token',
    ];

    // Relação com o modelo "Medico"
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medico_id');
    }

    // Relação com o modelo "Paciente"
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
    
     // Relação 1 para 1 com a model "RegistroDeDespensa"
     public function registroDeDespensa()
     {
         return $this->hasOne(RegistroDeDespensa::class);
     }

     // Relação 1 para N com a model "Prescricao"
    public function prescricoes()
    {
        return $this->hasMany(Prescricao::class);
    }
}