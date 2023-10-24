<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Farmacia extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'farmacias';
    protected $primaryKey = 'id';

    protected $fillable = [
        'cnpj',
        'telefone',
        'celular',
        'cep',
        'estado',
        'cidade',
        'bairro',
        'rua',
        'qrcode_assinatura',
    ];

    //Possui varios Users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Relação 1 para N com a model "RegistroDeDespensa"
    public function registrosDeDespensa()
    {
        return $this->hasMany(RegistroDeDespensa::class);
    }

}
