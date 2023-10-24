<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medico extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'medicos';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'aprovado',
        'crm',
        'especialidade',
        'cpf',
        'rg',
        'data_nascimento',
        'telefone',
        'celular',
        'cep',
        'estado',
        'cidade',
        'bairro',
        'rua',
        'qrcode_assinatura',
    ];

    // Relação 1 para N com a model "Users"
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Relação 1 para N com a model "Paciente"
    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }

     // Relação 1 para N com a model "Receita"
     public function receitas()
     {
         return $this->hasMany(Receita::class);
     }
}
