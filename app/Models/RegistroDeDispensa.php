<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroDeDispensa extends Model
{
    use HasFactory;
    protected $table = 'registros_de_dispensa';

    protected $fillable = [
        'receitas_id',
        'farmacias_id1',
        'data_dispensa',
        'conteudo_da_dispensa',
        'nome_balconista',
        'crf',
    ];

    // Relação com o modelo "Receita"
    public function receita()
    {
        return $this->belongsTo(Receita::class, 'receitas_id');
    }

    // Relação com o modelo "Farmacia"
    public function farmacia()
    {
        return $this->belongsTo(Farmacia::class, 'farmacias_id');
    }

}

