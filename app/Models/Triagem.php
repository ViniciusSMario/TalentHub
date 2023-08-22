<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Triagem extends Model
{
    use HasFactory;

    protected $fillable = [
        'vaga_id',
        'candidato_id',
        'analise_curriculo',
        'teste_comportamental',
        'teste_pratico',
        'entrevista',
        'reprovado',
        'aprovado',
    ];

    public function candidatos()
    {
        return $this->belongsTo(Candidato::class, 'candidato_id');
    }

    public function vagas()
    {
        return $this->belongsTo(Vaga::class, 'vaga_id');
    }
}
