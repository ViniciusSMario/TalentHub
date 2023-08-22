<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vaga extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'descricao',
        'tipo_vaga',
        'atividades',
        'pre_requisitos',
        'nivel',
        'beneficios',
        'remuneracao',
        'empresa',
        'datahora_fechamento',
    ];

    public function candidatos()
    {
        return $this->hasMany(Candidato::class, 'vaga_id');
    }

    public function triagems()
    {
        return $this->hasMany(Triagem::class, 'vaga_id');
    }
}
