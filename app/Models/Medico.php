<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medico extends Model
{
    use HasFactory;
    protected $table = 'medicos';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'consultorio_clinica',
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
        'numero',
        'qrcode_assinatura',
        'token_aprovacao',
    ];

    public function generateUniqueToken()
    {
        do {
            $token_aprovacao = Str::random(40); // Gere um token aleatório
        } while (static::where('token_aprovacao', $token_aprovacao)->exists()); // Verifique se o token já existe na tabela

        $this->update(['token_aprovacao' => $token_aprovacao]); // Atualize o campo 'token_aprovacao' do médico
        return $token_aprovacao;
    }

    // Relação 1 para N com a model "Users"
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Relação 1 para N com a model "Paciente"
    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'medicos_id');
    }

     // Relação 1 para N com a model "Receita"
     public function receitas()
     {
         return $this->hasMany(Receita::class);
     }
}
