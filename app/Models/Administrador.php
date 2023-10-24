<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    protected $redirectTo = '/admin/dashboard'; 
    protected $fillable = [
        'users_id',
    ];

    // Relação 1 para 1 com o modelo "User"
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}

