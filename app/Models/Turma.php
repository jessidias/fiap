<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'tipo'];

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }
}
