<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'data_nascimento', 'usuario'];

    protected $casts = [
        'data_nascimento' => 'datetime',
    ];

}
