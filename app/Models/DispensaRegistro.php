<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispensaRegistro extends Model
{
    use HasFactory;

    protected $table = 'registros_de_dispensa';

    protected $fillable = [
        'farmacia_id',
        'receita_id',
        'data_dispensa',
        'conteudo_da_dispensa',
        'nome_balconista',
        'crf',
    ];

    // Relação com a tabela "farmacias"
    public function farmacia()
{
    return $this->belongsTo(Farmacia::class, 'farmacias_id');
}


    // Relação com a tabela "receitas"
    public function receita()
    {
        return $this->belongsTo(Receita::class, 'receitas_id');
    }
}
