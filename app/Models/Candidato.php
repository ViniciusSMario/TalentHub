<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidato extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'url_curriculo',
        'sexo',
        'data_nascimento',
        'url_linkedin',
        'url_site',
        'url_instagram',
        'url_facebook',
        'endereco',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'telefone_contato',
        'estado_civil',
        'referencias',
        'informacoes_adicionais',
        'vaga_id',
    ];

    public function vagas()
    {
        return $this->belongsTo(Vaga::class, 'vaga_id');
    }

    public function triagems()
    {
        return $this->hasOne(Triagem::class, 'candidato_id');
    }
}
